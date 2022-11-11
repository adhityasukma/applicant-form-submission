<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      0.0.1
 *
 * @package    Applicant_Form_Submission
 * @subpackage Applicant_Form_Submission/public/partials
 */
?>
<div class="afs-container">
    <form method="post" enctype="multipart/form-data" class="afs-form-submission">
        <div class="afs-form-section">
            <label for="afs-nama-depan">
             <?php esc_attr_e("First Name","afs");?>
            </label>
            <input type="text" name="afs-nama-depan" id="afs-nama-depan" class="afs-form-input" placeholder="Enter First Name">
        </div>
        <div class="afs-form-section">
            <label for="afs-nama-belakang">
                <?php esc_attr_e("Last Name","afs");?>
            </label>
            <input type="text" name="afs-nama-belakang" id="afs-nama-belakang" class="afs-form-input" placeholder="Enter Last Name">
        </div>
        <div class="afs-form-section">
            <label for="afs-address">
                <?php esc_attr_e("Present Address","afs");?>
            </label>
            <textarea cols="4" rows="5" name="afs-address" id="afs-address" class="afs-form-input" placeholder="Enter Present Address"></textarea>
        </div>
        <div class="afs-form-section">
            <label for="afs-email-address">
                <?php esc_attr_e("Email Address","afs");?>
            </label>
            <input type="text" name="afs-email-address" id="afs-email-address" class="afs-form-input" placeholder="Enter Email Address">
        </div>
        <div class="afs-form-section">
            <label for="afs-mobile-phone">
                <?php esc_attr_e("Mobile No","afs");?>
            </label>
            <input type="text" name="afs-mobile-phone" id="afs-mobile-phone" class="afs-form-input" placeholder="Enter Mobile No">
        </div>
        <div class="afs-form-section">
            <label for="afs-post-name">
                <?php esc_attr_e("Post Name","afs");?>
            </label>
            <input type="text" name="afs-post-name" id="afs-post-name" class="afs-form-input" placeholder="Enter Post Name">
        </div>
        <div class="afs-form-section">
            <label for="afs-cv">
                <?php esc_attr_e("CV","afs");?>
            </label>
            <input type="file" name="afs-cv" id="afs-cv" accept=".doc, .docx, .pdf" class="afs-form-input" placeholder="CV">
        </div>
        <div class="afs-form-section">
            <input type="submit" name="afs-btn-submit" class="afs-form-input" value="Submit">
        </div>
    </form>
</div>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
