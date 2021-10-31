function getXmlHttp() {
	var xmlhttp;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {
			xmlhttp = false;
		}
	}
	if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
		xmlhttp = new XMLHttpRequest();
	}   return xmlhttp;
}


function jsonParse(j) {
    var out = '';
     
	for (var i in j)
	{
		out+= '<tr>';
		out+= '<td>' +j[i].id+   '</td>';
		out+= '<td>' +j[i].name+ '</td>';
		out+= '<td>' +j[i].mail+ '</td>';
		out+= '<td>' +j[i].phone+ '</td>';
		out+= '<td><figure><img class="img-circle" src="/img/' +j[i].icon+ '" alt="'+j[i].name+'" /><figure></td>';
		out+= '<td><label class="option"><input name="item[]" type="checkbox" class="checkdelTask" value="'+j[i].id+'"/><span class="checkbox"></span></label></td>';
		out+= '</tr>';
	}
	$('#tbody').html(out);
	$('#myTab li:first-child a').tab('show');
}


function xhrParse(file) {
	var info = 'File: '+file.name+' Size: '+file.size || 'No file!';
	$('#xhrStatus').text(info);
}

function uploadImage(file, that, size = 5)
{
	var reader,
		result,
		accept;
	var valIcon = (that.value != '') ? 'value' : '';

	accept = that.accept;
	accept.split(',');

	if ( typeof accept !== 'undefined' && !accept.includes(file.type) )
	{
		$('.labelFile .icon').removeClass(valIcon);
		result = 'Разрешены только изображения';
		that.value = '';
	}

	if ( typeof size !== 'undefined' && file.size > size * 1024 * 1024 )
	{
		$('.labelFile .icon').removeClass(valIcon);
		result = 'Файл должен быть не более '+ size +' Мб.';
		that.value = '';
	}

	if (that.value == '')
	{
		alert (result);
		return;
	}

	reader = new FileReader();
	reader.onload = function(e)
	{
		$('.labelFile .icon').addClass(valIcon);
		result = $('#srcImage');
		xhrParse(file);
		if (typeof result !== 'undefined')
		{
			result.attr('src', e.target.result);
		}
	}
	reader.onerror = function(e)
	{
		alert('Error!');  
		that.value = '';
		return;
	}
	reader.readAsDataURL(file);
}

function number_format(number, decimals, point, thousands_sep) 
{	// Format a number with grouped thousands
	var i, j, kw, kd, km;
	// input sanitation & defaults
	if( isNaN(decimals = Math.abs(decimals)) ){
		decimals = 0;
	}
	if( point == undefined ){
		point = ",";
	}
	if( thousands_sep == undefined ){
		thousands_sep = " ";
	}

	i = parseInt(number = (+number || 0).toFixed(decimals)) + "";
    j = (j = i.length) > 3 ? j % 3 : 0;

	km = (j ? i.substr(0, j) + thousands_sep : "");
	kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep); //kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
	kd = (decimals ? point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");
	return km + kw + kd;
}

function setLazy()
{
    lazy = document.querySelectorAll('img[loading=lazy]');
    console.log('Found '+lazy.length+' lazy images');
}

function lazyLoad()
{
	lazy.forEach(function(img)
	{
		if(isInViewport(img))
		{
			if (img.hasAttribute('data-src')) {
				img.src = img.getAttribute('data-src');
				img.removeAttribute('data-src');
			}
		}
	});
    
    //cleanLazy();
}

function cleanLazy(){
    lazy = Array.prototype.filter.call(lazy, function(e){ 
		return e.getAttribute('data-src');
	});
}

function isInViewport(el)
{
    var rect = el.getBoundingClientRect();
    return (
		rect.bottom >= 0 && rect.right >= 0 && 
		rect.top <= (window.innerHeight || document.documentElement.clientHeight) && 
		rect.left <= (window.innerWidth || document.documentElement.clientWidth)
	);
}

function registerListener(ev, func)
{
    if (window.addEventListener) {
        window.addEventListener(ev, func)
    } else {
        window.attachEvent('on' + ev, func)
    }
}

function print(output){
	document.write(output);
}
