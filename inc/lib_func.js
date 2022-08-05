function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function wait(effect, typecolor, target, text){

/* effect : win8, win8_linear, ios, progressBar, pulse, timer, rotation, facebook, bounce */			

			if (typecolor == 'danger') {
				var color = '#B94A48';
			}else if (typecolor == 'info') {
				var color = '#4BB1CF';
			}else if (typecolor == 'warning') {
				var color = '#FAA732';
			}else if (typecolor == 'success') {
				var color = '#5EB95E';
			}else if (typecolor == 'lavender') {
				var color = '#8854d0';
			}else if (typecolor == 'primary') {
				var color = '#3A87AD';
			}else{
				var color = '#000000';
			}
			

			var $loading = $(target).waitMe({
				effect: effect,
				text: text,
				bg: 'rgba(255,255,255,0.90)',
				color: color
			});
}

function stopWait(target){
	$(target).waitMe('hide');
}

function showAlert(typeAlert, title, text, type, timer, confirm){
	if (typeAlert == 1) {
		swal({
			title: title,
			text:  text,
			type: type,
			html: true,
			showConfirmButton: true
		});  

	}else{

		swal({
			title: title,
			text:  text,
			type: type,
			timer: timer,
			html: true,
			showConfirmButton: confirm
		});     

	}	

}

function showAlert(typeAlert, title, text, type, timer, confirm){
	if (typeAlert == 1) {
		swal({
			title: title,
			text:  text,
			type: type,
			html: true,
			showConfirmButton: true
		});  

	}else{

		swal({
			title: title,
			text:  text,
			type: type,
			timer: timer,
			html: true,
			showConfirmButton: confirm
		});     

	}	

}

function showData(target, url, block){
	wait('facebook', 'primary', block, 'Sedang Memuat...');
	$(target).load(url, function() {
	  stopWait(block);
	});
}

function notif(title, msg, type, delay){
	if (type == 'success') {
		var icon = 'glyphicon glyphicon-check';
	}else if (type == 'warning') {
		var icon = 'glyphicon glyphicon-warning-sign';
	}else if (type == 'danger') {
		var icon = 'glyphicon glyphicon-ban-circle';
	}else if (type == 'info') {
		var icon = 'glyphicon glyphicon-info-sign'
	}

    $.notify({
      title: '<strong>'+title+'!</strong>',
      icon: icon,
      message: msg,
    },{
      type: type,
      newest_on_top: true,
      placement: {
        from: "bottom",
        align: "right"
      },
      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: delay,
	  animate: {
			enter: 'animated bounceInRight',
			exit: 'animated bounceOutRight'
		},
	icon_type: 'class',
	template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
		'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
		'<table> ' +
		'<tr><td rowspan="2" style="font-size:35px; padding-right:10px;"><span data-notify="icon" ></span></td> ' +
		'<td><span data-notify="title">{1}</span></td></tr>' +
		'<tr><td><span data-notify="message">{2}</span></td></tr> ' +
		'</table> ' +
		'</div>'

	    });
}

    function CheckExtensionPDF(file) {
        /*global document: false */
        var validFilesTypes = ["pdf"];
        var filePath = file;
        var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
        var isValidFile = false;

        for (var i = 0; i < validFilesTypes.length; i++) {
            if (ext == validFilesTypes[i]) {
                isValidFile = true;
                break;
            }
        }
        return isValidFile;
    }

    function CheckExtensionIMG(file) {
        /*global document: false */
        var validFilesTypes = ["jpg", "jpeg", "png", "gif"];
        var filePath = file;
        var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
        var isValidFile = false;

        for (var i = 0; i < validFilesTypes.length; i++) {
            if (ext == validFilesTypes[i]) {
                isValidFile = true;
                break;
            }
        }
        return isValidFile;
    }
    function CheckExtensionIMGPDF(file) {
        /*global document: false */
        var validFilesTypes = ["jpg", "jpeg", "png", "gif", "pdf"];
        var filePath = file;
        var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
        var isValidFile = false;

        for (var i = 0; i < validFilesTypes.length; i++) {
            if (ext == validFilesTypes[i]) {
                isValidFile = true;
                break;
            }
        }
        return isValidFile;
    }


    function CheckExtension(file) {
        /*global document: false */
        var validFilesTypes = ["xlxs", "xlx", "docx", "doc", "pdf", "png", "jpg"];
        var filePath = file;
        var ext = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
        var isValidFile = false;

        for (var i = 0; i < validFilesTypes.length; i++) {
            if (ext == validFilesTypes[i]) {
                isValidFile = true;
                break;
            }
        }
        return isValidFile;
    }
    function validateFileSize(e) {
                /*global document: false */
                var file = e;
                var isValidFile = false;
                if (e !== 0 && e <= 1572864) {
                    isValidFile = true;
                }
                return isValidFile;
    }
