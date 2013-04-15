                <p>DiaryHelper thanks you oh-so very much for participating. Though you may think this project was all about helping you, Diary Helper learned a lot too. It is not always easy to keep a Diary, so please pat yourself on the back. A few things:</p>
              
              <p>1. This program is in Beta, and Diary Helper would love to know what you thought, and any suggestions of how the diary writing tool can be improved.</p>
              
                Feedback:<br />
                <form id="feedback-form" class="settings" name="feedback-form" method="post" action="sendfeedback.php">
                  <input id="language" name="language" type="hidden" value="<?php echo $lang;?>" />
                  <textarea class="answer feedback" id="feedback" name="feedback"></textarea>
                  <input id="diarist_id" name="diarist_id" type="hidden" value="<?php echo $diarist_id;?>" />
                  <input id="diarist_email" name="email" type="hidden" value="<?php echo $diarist_email;?>" />
                  <span><button class="submit-button" id="submit-button" name="submit-button" type="submit" value="submit">submit</button></span>
                </form>

                  <p>2. If you're not yet signed up for The Quickie email list, please do. You'll receive semi-weekly fresh Diaries and Diary-based art, not to mention keep up with DiaryHelper and The Sex Diaries Project. (You can change your mind any time.) </p>
          
                                    <!-- <form id="subscribe-form" class="settings" name="subscribe-form" method="post" action="subscribe.php">
                    <input id="diarist_id" name="diarist_id" type="hidden" value="<?php echo $diarist_id;?>" />
                    <span><button class="submit-button" id="submit-button" name="submit-button" type="submit" value="Subscribe">Subscribe</button></span>
                  </form> -->


<!--      <form action="/php/subscribe.php" method="POST" id="form"><input id="gatheremail" type="text" name="addemail" placeholder="your email">
      <input type="image" id="arrow" src="images/right-arrow-large.png" border="0" /></form> -->
      <!-- https://madmimi.com/signups/subscribe/44426 -->
      <form id="subscribe-form" class="settings" action="subscribe.php" method="POST" name="subscribe-form">
      <input id="gatheremail" type="text" name="signup[email]" placeholder="your email" value="<?=$diarist_email;?>">
      <input type="hidden" name="commit" value="Sign Up">
<span><button class="submit-button" id="submit-button" name="submit-button" type="submit" value="Subscribe">Subscribe</button></span>
      <input type="hidden" name="submit-button" type="submit" value="Subscribe">
</form>

          
          <p>3. Do you have any friends who you think would enjoy being Diarists? Enter  their email addresses below, and they'll receive an anonymous email  from DiaryHelper. (Don't worry: We're not saving their email addresses,  and you won't be mentioned. Promise.) </p>
          
                  <form id="refer-form" class="settings" name="refer-form" method="post" action="<?php echo $prefix; ?>referal.php">
                    <input name="refer[]" type="text" /><br />
                    <input name="refer[]" type="text" /><br />
                    <input name="refer[]" type="text" /><br />
                    <input name="refer[]" type="text" /><br />
                    <input name="refer[]" type="text" /><br />
                    <span><button class="submit-button" id="submit-button" name="submit-button" type="submit" value="Refer Friends">Refer Friends</button></span>
                  </form>
