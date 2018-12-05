<?php
  require('db/config.php');
  session_start();
  $request = array_merge($_POST, $_GET);
  if (!isset($request['type'])) {
    exit();
  }
  $type = $request['type'];
  if (isset($_SESSION['members']) && empty($request['seminarId'])) {
    $sess = $_SESSION['members'][$type];
  } else {
    // $sess = false;
    if (isset($request['seminarId'])) {
      $mas_id = $request['seminarId'];
      $str = '';
      if ($type == 'dean') {
        $str = " AND type = 'DEAN'";
      }
      if ($type == 'chair') {
        $str = " AND type = 'CHAIR'";
      }
      if ($type == 'fac') {
        $str = " AND type = 'FACULTY'";
      }
      $query = "SELECT * FROM ma_attendees WHERE ma_id = $mas_id$str";
      $ret = mysqli_query($conn, $query);
      $group = [];
      while($result = mysqli_fetch_assoc($ret)){
        $id = $result['id'];
        $group[$id] = [
          'hotel' => $result['hotel'],
          'diem' => $result['diem'],
          'reg' => $result['reg']
        ];
      }
      $sess = $group;
    } else {
      $sess = false;
    }
  }
?>
<?php if ($sess) { ?>
  <?php foreach ($sess as $key => $value) { ?>
  <div class="row <?php echo $type ?>_<?php echo $key ?>" style="padding-top: 10px">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>Hotel</label>
                <input type="text" class="form-control text-right money <?php echo $type ?>_field" value="<?php echo number_format($value['hotel'], 2, '.', ',') ?>" placeholder="0.00" data-key="<?php echo $key ?>" data-type="<?php echo $type ?>" id="<?php echo $type ?>_hotel_<?php echo $key ?>">
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>Diem</label>
                <input type="text" class="form-control text-right money <?php echo $type ?>_field" value="<?php echo number_format($value['diem'], 2, '.', ',') ?>" placeholder="0.00" data-key="<?php echo $key ?>" data-type="<?php echo $type ?>" id="<?php echo $type ?>_diem_<?php echo $key ?>">
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>Registration</label>
                <input type="text" class="form-control text-right money <?php echo $type ?>_field" value="<?php echo number_format($value['reg'], 2, '.', ',') ?>" placeholder="0.00" data-key="<?php echo $key ?>" data-type="<?php echo $type ?>" id="<?php echo $type ?>_reg_<?php echo $key ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer text-right">
          <button type="button" class="btn btn-danger btn-xs" name="button" onclick="removeForm('<?php echo $type ?>', <?php echo $key ?>)">REMOVE</button>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
<?php } ?>
<script type="text/javascript">
  $(function () {
    $('.money').on('change', function () {
      let value = $(this).val()
      value = parseFloat(value.replace(/,/g,''))
      $(this).val(addCommas(value.toFixed(2)))
    })

    $('.dean_field').on('blur', function () {
      let type = $(this).data('type')
      let key = $(this).data('key')
      updateEntries(type, key)
    })

    $('.fac_field').on('blur', function () {
      let type = $(this).data('type')
      let key = $(this).data('key')
      updateEntries(type, key)
    })

    $('.chair_field').on('blur', function () {
      let type = $(this).data('type')
      let key = $(this).data('key')
      updateEntries(type, key)
    })
  })

  function updateEntries (type, key) {
    let hotel = $(`#${type}_hotel_${key}`).val()
    let diem = $(`#${type}_diem_${key}`).val()
    let reg = $(`#${type}_reg_${key}`).val()
    let mas_id = "<?php echo (isset($mas_id) ? true : false) ?>";
    hotel = parseFloat(hotel.replace(/,/g, ''))
    diem = parseFloat(diem.replace(/,/g, ''))
    reg = parseFloat(reg.replace(/,/g, ''))

    $.post('ajax-create-entries.php', {type: type, hotel: hotel, diem: diem, reg: reg, key: key, mas_id: mas_id, mode: 'UPDATE'}, function (o) {
      loadEntries(type)
    }, 'json').fail(function () {
      notify(`failed loading data ${type}`, 'danger')
    });
  }
</script>
