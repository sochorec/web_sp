<?php

interface IController {

    /**
     * Zajisti vypsani prislusne stranky.
     *
     * @param string $pageTitle     nazev stanky
     * @return string               HTML kód specifické stránky
     */
    public function show(string $pageTitle):string;

}

?>
