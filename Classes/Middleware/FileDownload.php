<?php

declare(strict_types=1);

namespace Svenjuergens\Minidownload\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FileDownload implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $form = $request->getParsedBody();
        if (isset($form['minidownloadTrigger'], $form['downloadUid'], $form['passwortField'])
            && $request->getMethod() === "POST"
        ) {
            $contentElement = $this->getTTContentElement((int)$form['downloadUid']);
            if (
                $contentElement['CType'] === 'minidownload_minidownload'
                && $contentElement['tx_minidownload_download_pw'] === (string)$form['passwortField']) {
                $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
                $fileObjects = $fileRepository->findByRelation(
                    'tt_content',
                    'assets',
                    (int)$contentElement['uid']
                );

                if (is_array($fileObjects) && count($fileObjects) === 1) {

                    $filePath = Environment::getPublicPath() . '/' . $fileObjects[0]->getOriginalFile()->getPublicUrl();
                    $title = $fileObjects[0]->getOriginalFile()->getName();

                    $size = filesize($filePath);
                    if ($filePath !== '') {
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename=' . $title);
                        header('Content-Length: ' . $size);
                        header('Pragma: no-cache');
                        header('Expires: 0');
                        readfile($filePath);
                    } else {
                        header('HTTP/1.1 403 Forbidden');
                    }
                    die();
                }
            } else {
                $request = $request->withAttribute('minidownload', [$contentElement['uid'] => true]);
            }
        }
        return $handler->handle($request);
    }

    protected function getTTContentElement(int $ttContentElementUid)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tt_content');
        return $queryBuilder
            ->select('uid', 'CType', 'tx_minidownload_download_pw', 'assets')
            ->from('tt_content')
            ->where(
                $queryBuilder->expr()->eq(
                    'uid',
                    $queryBuilder->createNamedParameter($ttContentElementUid, \PDO::PARAM_INT)
                )
            )
            ->execute()
            ->fetchAssociative();
    }
}
