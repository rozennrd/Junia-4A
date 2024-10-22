<!DOCTYPE html>
<html>
  <?php 
  session_start();
  $page = basename(__FILE__);
  $name = '';
  include ('head.php');
  ?>
  <body>

    <?php include ('header.php') ?>
    <!-- title -->
    <h1 class="big-title centered"><?php echo $name ?></h1>

    <!-- content -->
    <div class="container">
      <!-- Money money money -->
      <div class="jumbotron row centered shadow rounded">
        <div id="lipsum">
          <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. In quis consectetur tellus, ut iaculis risus. Sed ligula erat, feugiat ac sollicitudin nec, sodales a nisl. Nunc eget sem quis diam sagittis convallis. Aenean laoreet nulla sed velit ornare gravida. Vivamus pulvinar varius nisi, nec scelerisque leo efficitur sed. Integer pulvinar aliquet malesuada. In non leo tempor, luctus augue id, imperdiet mauris. In hac habitasse platea dictumst. Curabitur in commodo urna. Etiam consectetur metus vel leo rhoncus imperdiet. Ut aliquet placerat diam ac accumsan.
          </p>
          <p>
          Sed dignissim nunc nisl, ut elementum orci rutrum nec. Pellentesque a sapien eget enim accumsan aliquet at non magna. Fusce tincidunt, lectus ac finibus lacinia, augue metus congue ligula, vel interdum nunc elit a urna. Proin aliquet et enim at volutpat. Sed consectetur nunc non nunc ultricies, sit amet gravida turpis imperdiet. Nullam felis nulla, ornare ac egestas a, tincidunt quis lacus. Pellentesque at purus est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris consequat dapibus lacus quis dapibus. In tempor augue ac nulla ornare tempor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent pellentesque faucibus augue vel sodales. Suspendisse mollis tristique dui, non vehicula ipsum vehicula eget.
          </p>
          <p>
          Sed enim mi, sodales ut tellus ac, pellentesque convallis est. Vestibulum mollis lectus sed quam tempus scelerisque. Aenean eu metus dapibus, sagittis orci sed, viverra enim. Aenean volutpat velit in vestibulum porta. Vestibulum id quam a massa ultrices dapibus. Vivamus facilisis non purus nec accumsan. Curabitur id cursus libero. Nunc eget lacinia justo. Phasellus et dui at est porttitor fringilla. Pellentesque consequat maximus neque non eleifend. Quisque eu neque nec magna placerat imperdiet ut vel leo.
          </p>
          <p>
          Vestibulum accumsan orci ut nibh iaculis gravida. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce venenatis ex at tincidunt posuere. Proin facilisis non neque quis laoreet. Aliquam erat volutpat. Aliquam congue felis eget nisi aliquet, et laoreet tellus hendrerit. Curabitur mollis mi non malesuada imperdiet. Mauris bibendum, ex sit amet mattis ultricies, elit tellus ornare nisi, in porttitor leo dolor et velit. Duis at interdum nisl, ac malesuada lorem. Quisque quis fringilla mauris. Maecenas dapibus mi diam, sit amet elementum urna viverra a. Pellentesque vehicula vel velit a pellentesque. Nullam eu ex et felis scelerisque placerat nec ac mi. Suspendisse rutrum urna viverra, pulvinar neque quis, sollicitudin dolor. Suspendisse quis ultricies risus, quis cursus diam.
          </p>
          <p>
          Proin odio purus, rutrum blandit erat eget, rutrum ornare nisl. Sed at volutpat ante. Vestibulum a augue lacus. In hac habitasse platea dictumst. Donec et diam eget sem egestas laoreet at nec tellus. Quisque aliquam felis eu mi viverra, nec volutpat massa pellentesque. Proin a tristique tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc arcu lorem, convallis eu quam ut, tempor molestie erat. Aliquam vestibulum suscipit nulla, a consectetur dolor auctor ac. Maecenas sodales ac velit eu convallis. Sed enim enim, aliquam quis tincidunt quis, congue quis felis. Vivamus at dui vitae quam mollis bibendum ac vitae metus. Morbi tempus ac magna eu tempus. Nunc vitae laoreet massa, ut semper neque.
          </p></div>

      </div>
    </div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
  </body>
</html>
