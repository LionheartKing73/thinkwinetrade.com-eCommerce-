<div class="container">
<?php echo $admin_footer; ?>

</div>

<?php if (isset($zopim_user)) { ?>
  <!--Start of Zopim Live Chat Script-->
  <script type="text/javascript">
  window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
  d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
  _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
  $.src="//v2.zopim.com/?3LcmS0MQlxbjR4l7yn9HPv6x7ha7JocC";z.t=+new Date;$.
  type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
  </script>

  <script type="text/javascript">
  $zopim(function() {
      $zopim.livechat.setName('<?php echo $zopim_user; ?>');
      $zopim.livechat.setEmail('<?php echo $zopim_email; ?>');
    });
    </script>
  <!--End of Zopim Live Chat Script-->
<?php } ?>


<footer id="footer">Thinkwinetrade.com 2015</div>
</body></html>