$Id: readme_jp.txt,v 1.1 2011/12/29 14:37:12 ohwada Exp $

=================================================
�v���O�C���̍���
=================================================

�v���O�C������ "foobar" �Ƃ��܂�

1. �v���O�C���̋L�q��

plugins/foobar.php
------
if( !class_exists('rssc_plugin_foobar') ) 
{

class rssc_plugin_foobar extends rssc_plugin_base
{

function rssc_plugin_foobar()
{
	parent::__construct();
}

function description()
{
	// �����͉p��̐�����
	return "this is foobar description";
}

function convert()
{
	$content = $this->get_value_by_key( 'content' );
	$converted = xxx;	// �����ɕϊ�����������
	$this->set_value_by_key( 'content', $converted );
	return true;
}

} // class �̏I���
} // class_exists �̏I���
-----

2. ���{��̐������̋L�q��

plugins/language/japanese/foobar.php
-----
$rssc_plugin_description = "����� foobar �̐������ł�";
-----
