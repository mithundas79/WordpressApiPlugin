var WpAccount = function(domain){
    this.domain = domain;
    this.initialCategory;
    //this.sessionCategory = sessionCategory;
    this.wpAccountId;
    this.wpAccountTail;
    this.postUrl;
    this.postId;
    this.loadFunc;
    this.destinationCategory;
    this.encodeJs = new Encode();
    
    this.loadBigData = function(url, container){
        //alert(container);
        $.ajax({
		type : "GET",
		url : url,
		dataType : 'html',
		cache : true, // (warning: this will cause a timestamp and will call the request twice)
		beforeSend : function() {
			// cog placed
			container.html('<h1><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
                        //alert(container.html());
			// only draw breadcrumb if it is content material
			// TODO: check if document title injection refreshes in IE...
			// TODO: see the framerate for the animation in touch devices
			if (container[0] == $("#content")[0]) {
				drawBreadCrumb();
				// update title with breadcrumb...
				document.title = $(".breadcrumb li:last-child").text();
				// scroll up
				$("html, body").animate({
					scrollTop : 0
				}, "fast");
			} else {
				container.animate({
					scrollTop : 0
				}, "fast");
			}
		},
		/*complete: function(){
	    	// Handle the complete event
	    	// alert("complete")
		},*/
		success : function(data) {
			// cog replaced here...
			// alert("success")
			
			container.css({
				opacity : '0.0'
			}).html(data).delay(50).animate({
				opacity : '1.0'
			}, 300);
			

		},
		error : function(xhr, ajaxOptions, thrownError) {
			container.html('<h4 style="margin-top:10px; display:block; text-align:left"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4> <br>Or you are running this page from your hard drive. Please make sure for all ajax calls your page needs to be hosted in a server');
		},
		async : true
	});
    }
    
    
    this.inactivateAll = function (){
        $( ".inbox-menu-lg > .active" ).attr( "class", "" );
    }
    
    this.markAsActive = function (eleId){
        $( "#"+eleId ).attr( "class", "active" );
    }
    
    this.refreshSlugs = function(){
        var url = this.domain;
        $.ajax({
		type : "GET",
		url : url,
		dataType : 'html',
		cache : true, // (warning: this will cause a timestamp and will call the request twice)
		success : function(data) {
			// cog replaced here...
			// alert("success")
			
			$('#wp-slugs').html(data);
			

		},
		error : function(xhr, ajaxOptions, thrownError) {
			$('#wp-slugs').html('<i class="fa fa-warning txt-color-orangeDark"></i> Error 404! ');
		}
	});
    }
    
    this.loadCategories = function(){
        var url = this.domain+'wordpress_manager/wp_readers/categories';
        $.ajax({
		type : "GET",
		url : url,
		dataType : 'html',
		cache : true, // (warning: this will cause a timestamp and will call the request twice)
		success : function(data) {
			// cog replaced here...
			// alert("success")
			
			$('#wp-categories').html(data);
			

		},
		error : function(xhr, ajaxOptions, thrownError) {
			$('#wp-categories').html('<i class="fa fa-warning txt-color-orangeDark"></i> Error 404! ');
		}
	});
    }
    
    this.loadMenus = function(){
        var url = this.domain+"wordpress_manager/wp_readers/menus";
        $.ajax({
		type : "GET",
		url : url,
		dataType : 'html',
		cache : true, // (warning: this will cause a timestamp and will call the request twice)
		success : function(data) {
			// cog replaced here...
			// alert("success")
			
			$('#labels-trigger').html(data);
			

		},
		error : function(xhr, ajaxOptions, thrownError) {
			$('#labels-trigger').html('<i class="fa fa-warning txt-color-orangeDark"></i> Error 404! ');
		}
	});
    }
    
    this.loadPosts = function () {
        var url = this.domain+'wordpress_manager/wp_readers/posts';
        this.loadBigData(url, $('#post-content'))
    }
    
    this.loadView = function (){
        var id = this.postId;
        var url = this.domain+"wordpress_manager/wp_readers/view/"+id;
        this.loadBigData(url, $('#post-content'));            
    }
    
    
    this.loadPages = function(){
        var url = this.domain;
        $.ajax({
		type : "GET",
		url : url,
		dataType : 'html',
		cache : true, // (warning: this will cause a timestamp and will call the request twice)
		success : function(data) {
			// cog replaced here...
			// alert("success")
			
			$('#pages-triger').html(data);
			

		},
		error : function(xhr, ajaxOptions, thrownError) {
			$('#pages-triger').html('<i class="fa fa-warning txt-color-orangeDark"></i> Error 404! ');
		}
	});
    }
    
    /**
     * submit the inbox data to this.postUrl
     */
    this.submitInboxData = function (){
        var processForm = true;
        var mode = $("#data-mode").val();
        var spmode = $("#data-sp-mode").val();
        if(mode == 'list'){
            var isChecked = $('.inbox-table-icon input:checkbox').is(':checked');
            if (!isChecked) {
                alert("Select a post");
                processForm = false;
            }
        }
        if (processForm) {
            var postData = $( "#post-frm" ).serialize();
            alert(postData);
            var url = this.postUrl;
            var wpJs = this;
            var data_postId = $("#data-postId-0").val();
            
            $('#post-content').html('<h1><i class="fa fa-cog fa-spin"></i> Working...</h1>');
            $.post( url, postData)
                .done(function( data ) {
                    //alert(data);
                    
                    if(data){
                        //alert(spmode);
                        if((mode == 'list') || (spmode == 'list-sp')){
                            wpJs.postId = "";
                            wpJs.loadPosts();
                        }else{
                            wpJs.postId = data_postId;
                            wpJs.loadView();
                        }
                    }else{
                        alert(data);
                    }
                });
        }

    }
    
}