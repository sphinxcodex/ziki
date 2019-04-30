<?php
$rss = new DOMDocument();
$feed = [];
$urlArray = array(array('name' => 'WordPress', 'url' => 'C:\Users\user\ziki-1\storage\contents\rss.xml'),
                  array('name' => 'Duolingo',  'url' => 'C:\Users\user\ziki-1\rss\rss.xml')
                  );

foreach ($urlArray as $url) {
    $rss->load($url['url']);

    foreach ($rss->getElementsByTagName('item') as $node) {
        $item = array (
            'site'  => $url['name'],
            'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'desc'  => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'link'  => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'date'  => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
            );
        array_push($feed, $item);
    }
}//print_r($feed);
usort($feed, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});
$limit = 12;
echo '<ul>';
for ($x = 0; $x < $limit; $x++) {
    $site = $feed[$x]['site'];
    $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
    $link = $feed[$x]['link'];
    $description = $feed[$x]['desc'];
    $date = date('l F d, Y', strtotime($feed[$x]['date']));

    echo '<li>';
    echo '<strong>'.$site.': <a href="'.$link.'" title="'.$title.'" target="_blank">'.$title.'</a></strong> ('.$date.')';
    echo '</li>';
}
echo '</ul>';
