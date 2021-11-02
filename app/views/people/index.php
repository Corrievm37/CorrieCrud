<?php require APPROOT . '/views/inc/header.php'; ?>
    <?php flash('person_message'); ?>
  <div class="row ">
      <div class="col-md-8">
          <h2>Our CRUD System</h2>
      </div>
      <div class="col-md-4">
          <a class="btn btn-primary pull-right" href="<?php echo URLROOT ;?>/people/add"><i class="fa fa-pencil"></i> Add Person</a>
      </div>
  </div>
    <table class="table table-hover  table-sm">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Surname</th>
            <th scope="col">Email</th>
            <th scope="col">Id Nr</th>
            <th scope="col">Cell Nr</th>
            <th scope="col">Birthdate</th>
            <th scope="col">Language</th>
            <th scope="col">Interest</th>
        </tr>
        </thead>
        <tbody>
  <?php foreach ($data['people'] as $person) : ?>
        <tr><th scope="row"><?php echo  $person->name ;?></th>
            <td><?php echo  $person->surname ;?></td>
            <td><?php echo  $person->email ;?></td>
            <td><?php echo  $person->idnr ;?></td>
            <td><?php echo  $person->cellnr ;?></td>
            <td><?php echo  $person->birthdate ;?></td>
            <td><?php echo  $person->language ;?></td>
            <td><?php foreach (json_decode($person->interest) as $interest) { echo "<span class='badge badge-primary'>".$interest."</span><br />";} ?></td>
            <td style='white-space: nowrap'><div class="btn-group" role="group"><a href="<?php echo URLROOT ;?>/People/edit/<?php echo $person->id ;?>" class="btn btn-dark btn-block btn-primary"><i class="fa fa-edit"></i></a></div>
                <div class="btn-group" role="group"><a href="<?php echo URLROOT ;?>/People/delete/<?php echo $person->id ;?>" class="btn btn-danger btn-block btn-primary"><i class="fa fa-remove"></i></a></div></td>
        </tr>

        </div>
  <?php endforeach ;?>
        </tbody>
    </table>
<?php require APPROOT . '/views/inc/footer.php'; ?>