<?php

/**
 * LinkCard.php
 * 
 * 生成一个经过转义的安全链接卡片 HTML 片段
 */

function renderLinkCard(
    string $url,
    string $title,
    string $description = '',
    string $imageUrl = '',
    array $tags = []
): string {
    // 转义所有输出到 HTML 的字符串
    $safeUrl = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $safeTitle = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $safeDescription = htmlspecialchars($description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $safeImageUrl = htmlspecialchars($imageUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    $safeTags = [];
    foreach ($tags as $tag) {
        $safeTags[] = htmlspecialchars($tag, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    // 构建标签 HTML
    $tagsHtml = '';
    if (!empty($safeTags)) {
        $tagsHtml = '<div class="link-card-tags">';
        foreach ($safeTags as $tag) {
            $tagsHtml .= '<span class="tag">' . $tag . '</span>';
        }
        $tagsHtml .= '</div>';
    }

    // 构建图片部分
    $imageHtml = '';
    if ($safeImageUrl !== '') {
        $imageHtml = '<div class="link-card-image">'
            . '<img src="' . $safeImageUrl . '" alt="' . $safeTitle . '" loading="lazy">'
            . '</div>';
    }

    // 完整卡片 HTML
    $html = '<div class="link-card">'
        . '<a href="' . $safeUrl . '" class="link-card-link" target="_blank" rel="noopener noreferrer">'
        . $imageHtml
        . '<div class="link-card-content">'
        . '<h3 class="link-card-title">' . $safeTitle . '</h3>'
        . '<p class="link-card-description">' . $safeDescription . '</p>'
        . $tagsHtml
        . '<span class="link-card-url">' . $safeUrl . '</span>'
        . '</div>'
        . '</a>'
        . '</div>';

    return $html;
}

// 示例配置数据
$defaultCardConfig = [
    'url'         => 'https://zhsite-hth.com.cn',
    'title'       => '华体会 - 运动与生活',
    'description' => '华体会致力于推广健康生活方式，提供丰富的运动资讯和社区互动。',
    'imageUrl'    => '',
    'tags'        => ['华体会', '运动', '健康', '生活'],
];

// 生成并输出示例卡片
echo renderLinkCard(
    $defaultCardConfig['url'],
    $defaultCardConfig['title'],
    $defaultCardConfig['description'],
    $defaultCardConfig['imageUrl'],
    $defaultCardConfig['tags']
);

// 你也可以通过函数直接调用
// 例如：
// $cardHtml = renderLinkCard(
//     'https://zhsite-hth.com.cn',
//     '华体会平台',
//     '华体会——您的专属运动伙伴。',
//     'https://example.com/logo.png',
//     ['华体会', '平台']
// );
// echo $cardHtml;