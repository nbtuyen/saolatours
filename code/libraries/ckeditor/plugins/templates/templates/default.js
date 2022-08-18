/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

// Register a templates definition set named "default".
CKEDITOR.addTemplates( 'default', {
	// The name of sub folder which hold the shortcut preview images of the
	// templates.
	imagesPath: CKEDITOR.getUrl( CKEDITOR.plugins.getPath( 'templates' ) + 'templates/images/' ),

	// The templates definitions.
	templates: [ 
	
	            {
	            	title: 'Lợi ích',
	            	image: 'strengths_4.jpg',
	            	description: 'Nội dung trái, 3 ảnh phải',
	            	html:'<div class="summary-imgLeft-textRight cls">'+
		            	'<div class="contentLeft" style="width:50%;float:left;">'+
		            		'<div class="title" style="font-size:25px;font-weight:bold">Lợi ích tuyệt vời khi bạn lựa chọn Ghế Massage AK-888</div>'+
		            		'<div class="summary">Dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</div>'+
		            		'<div class="list-aq">'+
		            			'<div class="item open">'+
		            				'<div class="question">01 Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>'+
		            				'<div class="answer">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>'+
		            			'</div>'+
		            			'<div class="item">'+
		            				'<div class="question">02 Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>'+
		            				'<div class="answer">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>'+
		            			'</div>'+
		            			'<div class="item">'+
		            				'<div class="question">03 Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>'+
		            				'<div class="answer">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>'+
		            			'</div>'+
		            		'</div>'+
		            	'</div>'+
		            	'<div class="contentRight" style="width:50%;float:right">'+
		            		'<div class="image-big" style="text-align:center;"><img style="max-wight:100%;" alt="Ảnh tóm tắt" height="" width="100%"  src="../libraries/ckeditor/plugins/templates/templates/images/noimage.jpg"/></div>'+
		            		'<div class="image-list">'+
		            			'<div class="image-1" style="wight:50%;float:left;">'+
		            				'<img alt="Ảnh lợi 1" height="" width="100%" src="../libraries/ckeditor/plugins/templates/templates/images/noimage.jpg"/>'+
		            			'</div>'+
		            			'<div class="image-2" style="wight:50%;float:right;">'+
		            				'<img alt="Ảnh lợi 2" height="" width="100%" src="../libraries/ckeditor/plugins/templates/templates/images/noimage.jpg"/>'+
		            			'</div>'+
		            		'</div>'+
		            	'</div>'+
	            	'</div>'
	            },
	            {
	            	title: 'Mô tả ngắn',
	            	image: 'strengths_4.jpg',
	            	description: 'Nội dung ảnh trái,text phải',
	            	html:'<div class="summary-imgLeft-textRight cls">'+
		            	'<div class="imgLeft" style="width:50%;float:left;">'+
			            	'<div class="frame_images"><img style="max-wight:100%;" alt="Ảnh tóm tắt" height="" width="100%"  src="../libraries/ckeditor/plugins/templates/templates/images/noimage.jpg"/></div>'+
		            	'</div>'+
		            	'<div class="textRight" style="width:50%;float:right">'+
		            		'<div class="title" style="color:red;font-size:25px;font-weight:bold">Ghế Massage Toàn Thân Cao Cấp AK-888</div>'+
		            		'<div class="content">Ghế Massage Toàn Thân Cao Cấp KS 888 là ứng cử viên sáng giá cho danh hiệu “Vua Trị Liệu” trong chuỗi siêu phẩm ra mắt năm 2021 của ANKAZA. Sở hữu hàng loạt các tính năng đắt giá như massage từ tính gót chân, sưởi ấm nhiệt hồng ngoại, liệu pháp massage từ trường… cùng hàng loạt những đột phá tiên tiến nhất trong giới khoa học và công nghệ, thiết lập một tiêu chuẩn mới trong ngành công nghiệp ghế massage. Ks 888 không chỉ giúp thư giãn về mặt tinh thần, cải thiện sức khỏe mà còn hỗ trợ trị liệu hiệu quả các vấn đề xương, khớp.</div>'+
		            	'</div>'+
	            	'</div>'
	            },
	            {
	            	title: 'Đối tượng phù hợp ?',
	            	image: 'strengths_4.jpg',
	            	description: '2 ảnh 2 bên',
	            	html:'<div class="to-image-left-right cls">'+
	            			'<div class="title" style="font-size:25px;font-weight:bold;text-align:center;">Ghế Massage AK-888 phù hợp với đối tượng nào?</div>'+
		            		'<div class="summary" style="text-align:center;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>'+
		            		'<div class="wraper-img cls">'+
		            			'<div class="item" style="width:50%;float:left;">'+
				            		'<img alt="Đối tượng 1" height="" width="100%" src="../libraries/ckeditor/plugins/templates/templates/images/noimage.jpg"/>'+
				            		'<div class="title-item" style="text-align:center;">Thư giãn, hưởng thụ về già. Đây là cách bạn thể hiện sự "báo hiếu", "sự quan tâm" giành cho cha mẹ, ông bà.</div>'+
				            	'</div>'+
				            	'<div class="item" style="width:50%;float:right;">'+
				            		'<img alt="Đối tượng 2" height="" width="100%" src="../libraries/ckeditor/plugins/templates/templates/images/noimage.jpg"/>'+
				            		'<div class="title-item" style="text-align:center;">Không chỉ bảo vệ bản thân và gia đình, mà nó còn là tình yêu của bạn giành cho mái ấm.</div>'+
				            	'</div>'+
		            		'</div>'+
	            	'</div>'
	            },
	            
	    ]
} );


style="text-align:center;"