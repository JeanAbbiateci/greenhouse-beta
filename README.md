Greenhouse Beta
===============

Unpacked version of the Greenhouse extension (for Safari).

Javascript libraries include:  
[Tipped.js](http://projects.nickstakenburg.com/tipped/documentation) (jQuery plugin for the tooltip)  
[Highlight.js](http://bartaz.github.io/sandbox.js/jquery.highlight.html) (jQuery plugin for highlighting)  
[List.js](http://listjs.com) (Javascript plugin for list sorting in popover)  
[jQuery](http://jquery.com) (of course)

Fonts and images are excluded.  
A PHP file being hosted on my website is included (retrieval.php).

###Explaination:
 1) Safari injects library js and css files at page start  
 2) Script.js (which runs the extension) is injected as an end script  
 3) Script.js uses the highlight.js library to scan the page for an array of names (found in names.js)  
 4) Highlight.js adds wraps names in span tag with class 'highlight-67132' if name is a Democrat, and 'highlight-16235' if Republican  
 5) Tipped.js, using AJAX, sends the candidate ID (paired to name in array) to the PHP hosted on my site  
 6) Using a Candidate's ID, the PHP file retrieves data from OpenSecrets API and echoes it back into the tooltip  
 7) Echoed tooltip contents are styled with styles.css file  
 
 ![alt text](http://i.imgur.com/SOcjgPL.png "Greenhouse Logo")  

