<style type="text/css">

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

.thumbnail{
position: relative;
z-index: 0;
}

.thumbnail:hover{
background-color: transparent;
z-index: 50;
}

.thumbnail span{ /*CSS for enlarged image*/
position: absolute;
background-color: lightyellow;
padding: 5px;
top: -100px;
left: -1000px;
border: 1px solid Black;
visibility: hidden;
color: black;
text-decoration: none;
max-height: 350px;
max-width: 350px;
}

.thumbnail span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
max-height: 350px;
max-width: 350px;
}

.thumbnail:hover span{ /*CSS for enlarged image on hover*/
visibility: visible;
top: -100;
left: 60px; /*position where enlarged image should offset horizontally */
max-height: 350px;
max-width: 350px;
}

</style>
