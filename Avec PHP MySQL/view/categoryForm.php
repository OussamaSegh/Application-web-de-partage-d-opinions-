<?php
 /*
-- Author : SEGHAIER Oussama 

*/
 
 $title = "Category Form"; ?>


<?php ob_start(); ?>

<form action="?action=createaddCategory" method="post">
		<div>
        	<label for="name_category">Nom Category :</label>
        	<input type="text" id="name_category" name="name_category" value="">
	    </div>

		<div>
        	<label for="description_category">Description Category :</label>
        	<input type="text" id="description_category" name="description_category" value="">
	    </div>

	    <div>
        	<label for="img_category">Image URL Category :</label>
        	<input type="file" id="img_category" name="img_category" value="">
	    </div>

	    <div class="button">
			<button type="submit" class="btn btn-primary"> Submit </button>
		</div>

</form>

<?php $content = ob_get_clean(); ?>

<!-- LOAD TEMPLATE -->
<?php require("template.php");