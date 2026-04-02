import {
	ClassicEditor,
	AccessibilityHelp,
	Alignment,
	Autoformat,
	AutoLink,
	Autosave,
	BlockQuote,
	Bold,
	Code,
	CodeBlock,
	Essentials,
	FindAndReplace,
	FontBackgroundColor,
	FontColor,
	FontFamily,
	FontSize,
	FullPage,
	GeneralHtmlSupport,
	Heading,
	Highlight,
	HorizontalLine,
	HtmlComment,
	HtmlEmbed,
	ImageBlock,
	ImageCaption,
	ImageInline,
	ImageInsert,
	ImageInsertViaUrl,
	ImageResize,
	ImageStyle,
	ImageTextAlternative,
	ImageToolbar,
	Indent,
	IndentBlock,
	Image,
	Italic,
	Link,
	Paragraph,
	RemoveFormat,
	SelectAll,
	ShowBlocks,
	SourceEditing,
	SpecialCharacters,
	SpecialCharactersArrows,
	SpecialCharactersCurrency,
	SpecialCharactersEssentials,
	SpecialCharactersLatin,
	SpecialCharactersMathematical,
	SpecialCharactersText,
	Strikethrough,
	Style,
	Subscript,
	Superscript,
	Table,
	TableCaption,
	TableCellProperties,
	TableColumnResize,
	TableProperties,
	TableToolbar,
	TextTransformation,
	Underline,
	Undo,
	SimpleUploadAdapter,
	List
}
	// from '@ckeditor/ckeditor5-build-classic';
	from 'ckeditor5';

// import FileRepository from '@ckeditor/ckeditor5-upload/src/filerepository'

const editorConfig = {
	toolbar: {
		items: [
			'heading',
			'bold',
			'|',
			'blockQuote',
			'codeBlock',
			'htmlEmbed',

			'|',
			'bulletedList',
			'numberedList',
			'italic',
			'|',
			'sourceEditing',
			'showBlocks',
			'code',
			'undo',
			'redo',
			'|',
			'findAndReplace',
			'selectAll',
			'|',
			'link',
			'insertImage',
			'|',
			'style',
			'|',
			'fontSize',
			'fontFamily',
			'fontColor',
			'fontBackgroundColor',
			'|',

			'underline',
			'strikethrough',

			'removeFormat',
			'|',
			'specialCharacters',
			'horizontalLine',

			'insertTable',
			'highlight',

			'|',
			'alignment',
			'|',
			'outdent',
			'indent',
			'subscript',
			'superscript',
			'|',
		],
		shouldNotGroupWhenFull: false
	},
	ui: {
		viewportOffset: {
			top: 50
		}
	},
	plugins: [
		// MyCustomUploadAdapterPlugin,
		SimpleUploadAdapter,
		AccessibilityHelp,
		Alignment,
		Autoformat,
		AutoLink,
		Autosave,
		BlockQuote,
		Bold,
		Code,
		CodeBlock,
		Essentials,
		FindAndReplace,
		FontBackgroundColor,
		FontColor,
		FontFamily,
		FontSize,
		FullPage,
		GeneralHtmlSupport,
		Heading,
		Highlight,
		HorizontalLine,
		HtmlComment,
		HtmlEmbed,
		ImageBlock,
		ImageCaption,
		ImageInline,
		ImageInsert,
		ImageInsertViaUrl,
		ImageResize,
		ImageStyle,
		ImageTextAlternative,
		ImageToolbar,
		Indent,
		IndentBlock,
		Image,
		ImageInsert,
		Italic,
		Link,
		Paragraph,
		RemoveFormat,
		SelectAll,
		ShowBlocks,
		SourceEditing,
		SpecialCharacters,
		SpecialCharactersArrows,
		SpecialCharactersCurrency,
		SpecialCharactersEssentials,
		SpecialCharactersLatin,
		SpecialCharactersMathematical,
		SpecialCharactersText,
		Strikethrough,
		Style,
		Subscript,
		Superscript,
		Table,
		TableCaption,
		TableCellProperties,
		TableColumnResize,
		TableProperties,
		TableToolbar,
		TextTransformation,
		Underline,
		Undo,
		List
	],
	// simpleUpload: {
	// 	// The URL that the images are uploaded to.
	// 	uploadUrl: (window.Laravel.routeType == 'local' ? "/dashboard" : "") + "/post/content_image?path=" + (window.pathImage ?? ''),
	// 	headers: {
	// 		'X-CSRF-TOKEN': document.getElementById("token").value,
	// 	}
	// },
	fontFamily: {
		supportAllValues: true
	},
	// image: {
	// 	toolbar: [
	// 		'toggleImageCaption',
	// 		'imageTextAlternative',
	// 		'|',
	// 		'imageStyle:inline',
	// 		'imageStyle:wrapText',
	// 		'imageStyle:breakText',
	// 		'|',
	// 		'resizeImage'
	// 	]
	// },
	fontSize: {
		options: [10, 12, 14, 'default', 18, 20, 22],
		supportAllValues: true
	},
	heading: {
		options: [
			{
				model: 'paragraph',
				title: 'Paragraph',
				class: 'ck-heading_paragraph'
			},
			{
				model: 'heading1',
				view: 'h1',
				title: 'Heading 1',
				class: 'ck-heading_heading1'
			},
			{
				model: 'heading2',
				view: 'h2',
				title: 'Heading 2',
				class: 'ck-heading_heading2'
			},
			{
				model: 'heading3',
				view: 'h3',
				title: 'Heading 3',
				class: 'ck-heading_heading3'
			},
			{
				model: 'heading4',
				view: 'h4',
				title: 'Heading 4',
				class: 'ck-heading_heading4'
			},
			{
				model: 'heading5',
				view: 'h5',
				title: 'Heading 5',
				class: 'ck-heading_heading5'
			},
			{
				model: 'heading6',
				view: 'h6',
				title: 'Heading 6',
				class: 'ck-heading_heading6'
			}
		]
	},
	htmlSupport: {
		allow: [
			{
				name: /^.*$/,
				styles: true,
				attributes: true,
				classes: true
			}
		]
	},
	// initialData:
	// 	'<h2>Congratulations on setting up CKEditor 5! 🎉</h2>\n<p>\n    You\'ve successfully created a CKEditor 5 project. This powerful text editor will enhance your application, enabling rich text editing\n    capabilities that are customizable and easy to use.\n</p>\n<h3>What\'s next?</h3>\n<ol>\n    <li>\n        <strong>Integrate into your app</strong>: time to bring the editing into your application. Take the code you created and add to your\n        application.\n    </li>\n    <li>\n        <strong>Explore features:</strong> Experiment with different plugins and toolbar options to discover what works best for your needs.\n    </li>\n    <li>\n        <strong>Customize your editor:</strong> Tailor the editor\'s configuration to match your application\'s style and requirements. Or even\n        write your plugin!\n    </li>\n</ol>\n<p>\n    Keep experimenting, and don\'t hesitate to push the boundaries of what you can achieve with CKEditor 5. Your feedback is invaluable to us\n    as we strive to improve and evolve. Happy editing!\n</p>\n<h3>Helpful resources</h3>\n<ul>\n    <li>📝 <a href="https://orders.ckeditor.com/trial/premium-features">Trial sign up</a>,</li>\n    <li>📕 <a href="https://ckeditor.com/docs/ckeditor5/latest/installation/index.html">Documentation</a>,</li>\n    <li>⭐️ <a href="https://github.com/ckeditor/ckeditor5">GitHub</a> (star us if you can!),</li>\n    <li>🏠 <a href="https://ckeditor.com">CKEditor Homepage</a>,</li>\n    <li>🧑‍💻 <a href="https://ckeditor.com/ckeditor-5/demo/">CKEditor 5 Demos</a>,</li>\n</ul>\n<h3>Need help?</h3>\n<p>\n    See this text, but the editor is not starting up? Check the browser\'s console for clues and guidance. It may be related to an incorrect\n    license key if you use premium features or another feature-related requirement. If you cannot make it work, file a GitHub issue, and we\n    will help as soon as possible!\n</p>\n',
	// link: {
	// 	addTargetToExternalLinks: true,
	// 	defaultProtocol: 'https://',
	// 	decorators: {
	// 		toggleDownloadable: {
	// 			mode: 'manual',
	// 			label: 'Downloadable',
	// 			attributes: {
	// 				download: 'file'
	// 			}
	// 		}
	// 	}
	// },
	link: {
		// 1. DESACTIVAR el comportamiento automático general
		addTargetToExternalLinks: false, // <-- IMPORTANTE: Cambiar a false
		defaultProtocol: 'https://',

		decorators: {
			// 2. Definir un decorador automático personalizado para ENLACES EXTERNOS
			// Lo llamamos "externalLink" (puedes usar el nombre que quieras)
			externalLink: {
				mode: 'automatic', // Es un decorador que se aplica automáticamente

				// Estos son los atributos que se añadirán al enlace (target="_blank" y rel="noopener noreferrer")
				attributes: {
					target: '_blank',
					rel: 'noopener noreferrer'
				},

				// 3. FUNCIÓN DE VERIFICACIÓN (CALLBACK)
				// Esta función se ejecuta para CADA enlace y decide si aplicar los atributos.
				callback: url => {
					// Si el enlace está vacío o no es un string, no aplicamos nada.
					if (!url) {
						return false;
					}

					// Convertimos la URL a minúsculas y verificamos si contiene el dominio interno.
					// Si la URL *contiene* el dominio (es un enlace INTERNO)...
					if (url.toLowerCase().includes('desarrollolibre.net') || url.toLowerCase().includes('laradesarrollolibre.test')) {
						return false; // ... NO APLICAMOS los atributos.
					}

					// Si la URL *no contiene* el dominio (es un enlace EXTERNO) O si es un
					// protocolo externo (http, https), APLICAMOS los atributos.
					return url.startsWith('http://') || url.startsWith('https://') || url.startsWith('//');
				}
			},

			// Mantenemos tu decorador manual
			toggleDownloadable: {
				mode: 'manual',
				label: 'Downloadable',
				attributes: {
					download: 'file'
				}
			}
		}
	},
	placeholder: 'Type or paste your content here!',
	style: {
		definitions: [
			{
				name: 'Article category',
				element: 'h3',
				classes: ['category']
			},
			{
				name: 'Title',
				element: 'h2',
				classes: ['document-title']
			},
			{
				name: 'Subtitle',
				element: 'h3',
				classes: ['document-subtitle']
			},
			{
				name: 'Info box',
				element: 'p',
				classes: ['info-box']
			},
			{
				name: 'Side quote',
				element: 'blockquote',
				classes: ['side-quote']
			},
			{
				name: 'Marker',
				element: 'span',
				classes: ['marker']
			},
			{
				name: 'Spoiler',
				element: 'span',
				classes: ['spoiler']
			},
			{
				name: 'Code (dark)',
				element: 'pre',
				classes: ['fancy-code', 'fancy-code-dark']
			},
			{
				name: 'Code (bright)',
				element: 'pre',
				classes: ['fancy-code', 'fancy-code-bright']
			}
		]
	},
	table: {
		contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
	},
	licenseKey: 'GPL',
	// extraPlugins: [MyCustomUploadAdapterPlugin],
};



ClassicEditor.create(document.querySelector('#editor'), editorConfig)

	.then(editor => {
		window.editor = editor;
		editor.ui.view.editable.element.setAttribute('spellcheck', 'true');

		const editableElement = editor.ui.view.editable.element;
		editableElement.setAttribute('spellcheck', 'true');
		//  editableElement.setAttribute('lang', 'es'); // importante para corrección en español
		window.addEventListener(
			"keydown",
			(event) => {
				if (/*event.code == "Numpad1" || */event.code == "F2") {
					event.preventDefault()
					// if (event.ctrlKey) {
					// en el ckeditor al marcar un texto coloca el bloque de codigo
					document.querySelector(".ck-splitbutton__action").click()
				}
			},
			true,
		);


	});
// if (document.querySelector('#editor2')) {
// 	ClassicEditor.create(document.querySelector('#editor2'), editorConfig).then(editor => {
// 		window.editor2 = editor;
// 		editor.ui.view.editable.element.setAttribute('spellcheck', 'true');

// 		const editableElement = editor.ui.view.editable.element;
// 		editableElement.setAttribute('spellcheck', 'true');
// 	});
// }
