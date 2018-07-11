 <div class="form-group">
			    <label for="jurusan">Mata Kuliah</label>
			    <?php $models =MataKuliah::model()->findAll(); ?>
			    <select type="text" class="form-control" id="mata_kuliah">
			    	<option>pilih</option>
			    	<?php foreach($models as $dpt){ ?>
			    	<option><?= $dpt['mata_kuliah']; ?></option>
			    	<?php } ?>
			    </select>
			  </div>