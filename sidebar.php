<div id="sidebar"> 
<ul> 
<?php if ( !function_exists('dynamic_sidebar')  
        || !dynamic_sidebar('sidebar') ) : ?>  
 <li><h2>About</h2>  
 <p>This is the deafult sidebar, add some widgets to change it.</p>
 </li>  
<?php endif; ?>  
</ul>
</div> 