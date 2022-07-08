/*
* Likes
* */

$('body').on('click', '.like-post', function(e){
    let id = this.dataset.id;
    $.ajax({
        url: "posts/like",
        data: {id: id},
        type: "get",
        success: function(res){
            console.log(this.classList.contains('text-primary'));
            if(this.classList.contains('text-primary')){
                this.classList.remove('text-primary');
            }else{
                this.classList.add('text-primary');
            }
        },
        error: function(){
          console.log("Error");
        },
    });

});

let showLike = (elem) => {
    if(elem.classList.contains('text-primary')){
        elem.classList.remove('text-primary');
    }else{
        elem.classList.add('text-primary');
    }
}


$('.file-dialog').on('click', function (){
    var input = document.getElementById('file-input');

    input.click();
});

let deleteImageBtns = document.getElementsByClassName('delete-image');

for(let i = 0; i < deleteImageBtns.length; i++){
    let btn = deleteImageBtns[i];

    btn.addEventListener('click', function(){
        path = btn.getAttribute('data-path'),
        postid = btn.getAttribute('data-postid');
        
            
        $.ajax({
            url: 'posts/delete-image',
            data: {
            path: path,
            id: postid,
            },
            type: "get",
            success: function(res){
                console.log(res);
                //this.style.display = "none";
                btn.classList.add('hide');
                //console.log(currentBtn);
            },
            error: function(){
                console.log("Something went wrong!");
            },
        });
    });
}

/* Search */
var users = new Bloodhound({
	datumTokenizer: Bloodhound.tokenizers.whitespace,
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	remote: {
		wildcard: '%QUERY',
		url: path + '/search/typeahead?query=%QUERY'
	}
});

users.initialize();

$("#typeahead").typeahead({
	// hint: false,
	highlight: true
},{
	name: 'users',
	display: 'title',
	limit: 10,
	source: users
});

$('#typeahead').bind('typeahead:select', function(ev, suggestion) {
	// console.log(suggestion);
	window.location = path + '/search/?s=' + encodeURIComponent(suggestion.title);
});

/* comments */

$('#comment-pic').on('click', function(){
    let cf = document.getElementById('comment-file');

    cf.click();
});

let showing = true;

$('#comment-view-more').on('click', function(){
    if(showing == true){
        showing = false;
    }else{
        showing = true;
    }

    let comments = $('.comment');

    let limit = 2;

    for(let i = 0; comments.length; i++){
        if(i == limit){
            if(showing == false){
                comments[i].fadeOut();
            }else{
                comments[i].fadeIn();
            }
        }
    }

});

let submit = $('.comment-submit').length;

for(let i = 0; i < submit.length; i++){
    let btn = submit[i];
    let form = btn.parentElement;

    console.log("form");
    console.log(form.serialize());

    btn.on('submit', function(){
        console.log("Start");
    });
}

$('#ajax-files').on('change', function(){
    $.ajax({
        url: "test/index",
        data: {},
        type: "post",
        success: function(res){
            $('.output').text(res);
            console.log(res);
            showImages(res);
        },
        error: function(){
          console.log("Error");
        },
    });
});

let showImages = (paths) => {

}

/*
$('#comment-submit').on('submit', function(){



    $.ajax({
       url: 'posts/delete-image',
       data: {
       path: path,
       id: postid,
       },
       type: "get",
       success: function(res){
           console.log(res);
           //this.style.display = "none";
           btn.classList.add('hide');
           //console.log(currentBtn);
       },
       error: function(){
           console.log("Something went wrong!");
       },
   });

});
*/

/* comments */