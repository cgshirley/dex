/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{

    config.toolbar = 'Normal';

	config.toolbar_Normal =
	[
	    ['Source','-','Templates'],
	    ['PasteText','PasteFromWord','SpellChecker'],
	    ['Undo','Redo'],
	   
	    ['Outdent','Indent'],
	    ['Link','Unlink'],
	    ['Image','Table','Smiley'],
	    '/',
	    ['Bold','Italic','Underline'],
	    ['Font','FontSize'],
	    ['TextColor','BGColor'],
	    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	    ['NumberedList','BulletedList']
	];


};
