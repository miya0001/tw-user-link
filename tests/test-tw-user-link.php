<?php
/**
 * Class TwUserLinkTest
 *
 * @package Tw_User_Link
 */

/**
 * User est case.
 */
class TwUserLinkTest extends WP_UnitTestCase {
	/**
	 * User name in string test.
	 */
	function test_tw_name_in_string() {
		$replace_to_link = replace_tw_user_name_to_link( 'こんにちは、@WordPressさん。' );
		$this->assertEquals( 'こんにちは、<a href="https://twitter.com/@WordPress">@WordPress</a>さん。', $replace_to_link );
	}

	/**
	 * Multiple user name in string test.
	 */
	function test_multiple_tw_name_in_string() {
		$replace_to_link = replace_tw_user_name_to_link( 'こんにちは、@WordPressさん。僕は、@wordpressdotcomですよ。@Automatticさんに作られています。' );
		$this->assertEquals( 'こんにちは、<a href="https://twitter.com/@WordPress">@WordPress</a>さん。僕は、<a href="https://twitter.com/@wordpressdotcom">@wordpressdotcom</a>ですよ。<a href="https://twitter.com/@Automattic">@Automattic</a>さんに作られています。', $replace_to_link );
	}

	/**
	 * Prohibited character test.
	 */
	function test_prohibited_character_in_tw_name() {
		$replace_to_link = replace_tw_user_name_to_link( 'こんにちは、@ワードプレスさん。僕は、@!"#$%&()=-~^です。彼女は@¥|@`[{;+:*]}, <。@.>/?' );
		$this->assertEquals( 'こんにちは、@ワードプレスさん。僕は、@!"#$%&()=-~^です。彼女は@¥|@`[{;+:*]}, <。@.>/?', $replace_to_link );
	}

	/**
	 * Available character test.
	 */
	function test_available_character_in_tw_name() {
		$replace_to_link = replace_tw_user_name_to_link( 'こんにちは、@ABCDEFGHIJKLMNOさん、@PQRSTUVWXYZ0123さん、@456789_さん、@abcdefghijklmnoさん、@pqrstuvwxyzさん。' );
		$this->assertEquals( 'こんにちは、<a href="https://twitter.com/@ABCDEFGHIJKLMNO">@ABCDEFGHIJKLMNO</a>さん、<a href="https://twitter.com/@PQRSTUVWXYZ0123">@PQRSTUVWXYZ0123</a>さん、<a href="https://twitter.com/@456789_">@456789_</a>さん、<a href="https://twitter.com/@abcdefghijklmno">@abcdefghijklmno</a>さん、<a href="https://twitter.com/@pqrstuvwxyz">@pqrstuvwxyz</a>さん。', $replace_to_link );
	}

	/**
	 * A <br> tag in string test.
	 */
	function test_br_tag_in_string() {
		$replace_to_link = replace_tw_user_name_to_link( 'こんにちは、@WordPressさん。<br>元気ですか？' );
		$this->assertEquals( 'こんにちは、<a href="https://twitter.com/@WordPress">@WordPress</a>さん。<br>元気ですか？', $replace_to_link );
	}

	/**
	 * List user name test.
	 */
	function test_list_tw_name() {
		$replace_to_link = replace_tw_user_name_to_link( 'こちらはWordPress関連のアカウント、<ul><li>@WordPressさん。</li><li>@wordpressdotcom</li><li>@Automattic</li></ul>です。' );
		$this->assertEquals( 'こちらはWordPress関連のアカウント、<ul><li><a href="https://twitter.com/@WordPress">@WordPress</a>さん。</li><li><a href="https://twitter.com/@wordpressdotcom">@wordpressdotcom</a></li><li><a href="https://twitter.com/@Automattic">@Automattic</a></li></ul>です。', $replace_to_link );
	}

	/**
	 * Xss test.
	 */
	function test_xss() {
		$replace_to_link = replace_tw_user_name_to_link( 'こんにちは、@<b>hello</b>さん。' );
		$this->assertEquals( 'こんにちは、@<b>hello</b>さん。', $replace_to_link );
	}

}
