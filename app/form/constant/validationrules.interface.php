<?php

interface ValidationRules
{
	const EMAIL = '^[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[.]{1}[A-Za-z]{2,5}$^';
	const NAME = '/^[a-zA-Z0-9-]+$/';
	const TEXT = '/^[a-zA-Z0-9_ ,.()\/:-]+$/';
	const PASS = '/^[a-zA-Z0-9_]{3,16}$/';
	const TICK = '/on/';
	const COMMENT = '/^[a-zA-Z0-9_ ,.]{5,100}+$/';
	const NONE = '/.*?/';
	const URL = '#((http|https|ftp)://(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|\'|:|\<|$|\.\s)#ie';
}

?>