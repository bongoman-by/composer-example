<?php

namespace bongoman\parser;

/**
 * @author Victor Zinchenko <zinchenko.us@gmail.com>
 */
class Parser implements ParserInterface {

     /**
     *
     * Парсер 
     *
     * Парсит страницу сайта, используя библиотеку phpQuery.php
     * и возвращает массив с краткими заголовками новостей
     * протестировано на http://www.bbc.com/ с тегом h3
     *
     * @param string $url ссылка на страницу
     * @param string $tag тег, по которому происходит парсинг
     * return array
     */
    public function process(string $url, string $tag) {

        $html = file_get_contents($url);

        $links = phpQuery::newDocument($html)->find($tag);

        $tmp = array();

        foreach ($links as $link) {

            $link = pq($link);

            $tmp[] = $link->text();
        }

        phpQuery::unloadDocuments();

        return $tmp;
    }

}
