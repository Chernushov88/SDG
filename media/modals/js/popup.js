/**
 * @package         Modals
 * @version         9.8.2PRO
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2018 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

var RegularLabsModalsPopup = null;

(function($) {
	"use strict";

	RegularLabsModalsPopup = {
		init: function() {
			$('ul.nav-tabs > li > a').on('shown.bs.tab', function() {
				$('#type').val($(this)[0].hash.replace('#tab-', '')).trigger('change');
			});

			var selection = this.getSelection();

			if (selection) {
				$('input[name="text"]').val(selection);
			}

			$('.reglab-overlay').css('cursor', '').fadeOut();
		},

		insertText: function() {
			var tag = this.getTag();

			if (!tag) {
				return false;
			}

			window.parent.Joomla.editors.instances[modals_editorname].replaceSelection(tag);

			return true;
		},

		getSelection: function() {
			var editor_textarea = window.parent.document.getElementById(modals_editorname);

			if (!editor_textarea) {
				return false;
			}

			var iframes = editor_textarea.parentNode.getElementsByTagName('iframe');

			if (!iframes.length) {
				return false;
			}

			var editor_frame  = iframes[0];
			var contentWindow = editor_frame.contentWindow;

			if (typeof contentWindow.getSelection !== 'undefined') {
				var sel = contentWindow.getSelection();
				if (sel.rangeCount) {
					var container = contentWindow.document.createElement("div");
					for (var i = 0, len = sel.rangeCount; i < len; ++i) {
						container.appendChild(sel.getRangeAt(i).cloneContents());
					}
					return container.innerHTML;
				}
			}

			if (typeof contentWindow.document.selection !== 'undefined'
				&& contentWindow.document.selection.type == "Text") {
				return contentWindow.document.selection.createRange().htmlText;
			}

			return false;
		},

		getTag: function(type) {
			var type = $('input[name="type"]').val();

			if (type == 'content') {
				return this.getTagContent(type);
			}

			var main_attributes = this.getAttributesByType(type);

			if (!main_attributes) {
				return false;
			}

			var extra_attributes = this.getAttributesExtra(type);

			return this.getTagoutput(main_attributes + ' ' + extra_attributes);
		},

		getTagContent: function() {

			var start = modals_tag_characters[0];
			var end   = modals_tag_characters[1];

			var id               = 'modal-content-' + Math.round(Math.random() * 1000);
			var content          = this.getEditorContents('content');
			var extra_attributes = this.getAttributesExtra(type);

			var tag = this.getTagoutput('content="' + id + '" ' + extra_attributes);

			var content_tag = start + modals_tag_content + ' ' + id + end
				+ content
				+ start + '/' + modals_tag_content + end

			return tag + '<br>' + "\n" + content_tag;
		},

		getTagoutput: function(attributes) {
			var start = modals_tag_characters[0];
			var end   = modals_tag_characters[1];

			var text = $('input[name="text"]').val();

			return start + modals_tag + ' ' + attributes.trim() + end
				+ text
				+ start + '/' + modals_tag + end;
		},

		getEditorContents: function(id) {
			return Joomla.editors.instances[id].getValue();
		},

		getAttributesExtra: function(type) {
			var attributes = [];

			var keys = [
				'title',
				'class',
				'classname',
				'width',
				'height'
			];

			for (var i = 0; i < keys.length; i++) {
				var attrib = this.getAttributesDefault(keys[i], '', true);
				attrib && attributes.push(attrib);
			}

			var value = $('input[name="iframe"]:checked').val();
			if (value != 0) {
				attributes.push('iframe="true"');
			}

			var value = $('input[name="open"]:checked').val();
			if (value != 0) {
				value = value == 1 ? 'true' : value;
				attributes.push('open="' + value + '"');
			}

			var value = $('input[name="autoclose"]').val();
			if (value > 0) {
				attributes.push('autoclose="' + value + '"');
			}

			return attributes.join(' ');
		},

		getAttributesByType: function(type) {
			switch (type) {
				case 'url':
					return this.getAttributesDefault('url', 'Please enter a URL', true);

				case 'image':
					return this.getAttributesDefault('image', 'Please select an image', false, 'url');

				case 'gallery':
					return this.getAttributesGallery();

				case 'video':
					return this.getAttributesVideo();

				case 'article':
					return this.getAttributesArticle();

				default:
					return false;
			}
		},

		getAttributesDefault: function(id, error, escape, key) {
			key = key ? key : id;

			var value = $('input[name="' + id + '"]').val();

			if (value == '') {
				error && alert(error);

				return false;
			}

			if (escape) {
				value = this.escape(value);
			}

			return key + '="' + value + '"';
		},

		getAttributesGallery: function() {
			var tag = this.getAttributesDefault('gallery', 'Please enter a gallery path', true);

			if (!tag) {
				return false;
			}

			var slideshow = $('input[name="slideshow"]:checked').val();
			var first     = $('select[name="first"]').val();
			var thumbnail = $('select[name="thumbnail"]').val();

			if (slideshow) {
				tag += ' slideshow="true"';
			}

			if (first) {
				tag += ' first="' + this.escape(first) + '"';
			}

			switch (thumbnail) {
				case '':
					break;
				case 'all':
					tag += ' showall="true"'
					break;
				default:
					tag += ' thumbnail="' + this.escape(thumbnail) + '"';
					break;
			}

			return tag;
		},

		getAttributesVideo: function() {
			var youtube = this.getYoutubeId();
			var vimeo   = this.getVimeoId();

			var key   = youtube ? 'youtube' : 'vimeo';
			var value = youtube ? youtube : vimeo;

			if (value == '') {
				alert('Please enter a Youtube or Vimeo id');

				return false;
			}

			return key + '="' + value + '"';
		},

		getAttributesArticle: function() {
			var value = $('input[name="article"]').val();

			if (value == '') {
				alert('Please select an article');

				return false;
			}

			var parts = value.split('::');

			value = $('input[name="article_type"]:checked').val() == 'id' ? parts[0] : parts[1]

			return 'article="' + value + '"';
		},

		getYoutubeId: function() {
			return $('input[name="youtube"]').val()
				.replace(/.*(?:youtu\.be\/?|youtube\.com\/embed\/?|youtube\.com\/watch\?v=)([^\/&\?]+)(?:\?|&amp;|&)?.*/, '$1');
		},

		getVimeoId: function() {
			return $('input[name="vimeo"]').val()
				.replace(/.*vimeo\.com\/(?:video\/)?([0-9]+).*/, '$1');
		},

		escape: function(str) {
			return (str + '').replace(/([\"])/g, '\\$1');
		}
	};

	$(document).ready(function() {
		setTimeout(function() {
			RegularLabsModalsPopup.init();
		}, 100);
	});
})
(jQuery);
