// JavaScript Document

jQuery(document).ready(function($) {

    $.each(nick, function(key, value) {
    	if(party[key] === "D") {
       	  $("p").highlight(key, {caseSensitive: false, className: 'highlight-67132' });
       	}
       	else {
       	  $("p").highlight(key, {caseSensitive: false, className: 'highlight-16235' });
       	}
    });
    
    $('.highlight-67132').each(function() {  	
    	var currentKey = $(this).text();
    	    	
    	 $.ajax({
                type: "POST",
                url: "http://data.nicholasrub.in/data.php",
                data: {"party": party[currentKey], "cand": nick[currentKey], "url": window.location.hostname, "fullurl": document.URL}   
          });
    	
        Tipped.create(this, "http://extension.nicholasrub.in/example.php", {
            ajax: { data: {id: nick[currentKey], pctg: pcts[currentKey]}, type: 'post' },
			skin: "white",
			hook: 'rightmiddle',
			maxWidth: 192,
			spinner: { 
			radius: 7,
  			height: 1,
 			width: 2.5,
 			dashes: 30,
 			opacity: 1,
 			padding: 10,
 			rotation: 700,
 			color: '#000000'
			},
        });
    });
    
      $('.highlight-16235').each(function() {  	
    	var currentKey = $(this).text();
    	
          $.ajax({
                type: "POST",
                url: "http://data.nicholasrub.in/data.php",
                data: {"party": party[currentKey], "cand": nick[currentKey], "url": window.location.hostname, "fullurl": document.URL} 
          });    	
          
        Tipped.create(this, "http://extension.nicholasrub.in/example.php", {
            ajax: { data: { id: nick[currentKey], pctg: pcts[currentKey]}, type: 'post' },
			skin: "white",
			hook: 'rightmiddle',
			maxWidth: 192,
			spinner: { 
			radius: 7,
  			height: 1,
 			width: 2.5,
 			dashes: 30,
 			opacity: 1,
 			padding: 10,
 			rotation: 700,
 			color: '#000000'
			},
        });
    });
});

