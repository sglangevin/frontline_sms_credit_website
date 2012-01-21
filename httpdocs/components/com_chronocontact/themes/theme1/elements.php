<!--start_cf_text-->
<div class="cf_item"> <span class="{cf_class}">{cf_labeltext}</span> </div>
<!--end_cf_text-->
<!--start_cf_heading-->
<div class="cf_item"> <{cf_tag} class="{cf_class}">{cf_labeltext}</{cf_tag}> </div>
<!--end_cf_heading-->
<!--start_cf_textbox-->
<div class="cf_item">
  <h3 class="cf_title">{cf_labeltext}</h3>
  <div class="cf_fields">
    <input name="{cf_name}" type="text" value="" class="cf_inputtext" maxlength="{cf_maxlength}" size="{cf_size}" id="{cf_id}" />
    <br />
    <label class="cf_botLabel">{cf_tooltip2}</label>
  </div>
</div>
<!--end_cf_textbox-->
<!--start_cf_password-->
<div class="cf_item">
  <h3 class="cf_title">{cf_labeltext}</h3>
  <div class="cf_fields">
    <input name="{cf_name}" type="password" value="" class="cf_inputtext" maxlength="{cf_maxlength}" size="{cf_size}" id="{cf_id}" />
    <br />
    <label class="cf_botLabel">{cf_tooltip2}</label>
  </div>
</div>
<!--end_cf_password-->
<!--start_cf_textarea-->
<div class="cf_item">
  <h3 class="cf_title"{cf_labeloptions}>{cf_labeltext}</h3>
  <div class="cf_fields">
    <textarea name="{cf_name}" cols="{cf_cols}" rows="{cf_rows}" id="{cf_id}" class="cf_textarea"></textarea>
    <br />
    <label class="cf_botLabel">{cf_tooltip2}</label>
  </div>
</div>
<!--end_cf_textarea-->
<!--start_cf_dropdown-->
<div class="cf_item">
  <h3 class="cf_title"{cf_labeloptions}>{cf_labeltext}</h3>
  <div class="cf_fields">
    <select class="cf_select" id="{cf_id}" size="{cf_size}" {cf_multiple} name="{cf_name}">
      <option value="">Choose Option</option>
      <cf_theoptions>
        <option value="{value}">{title}</option>
      </cf_theoptions>
    </select>
    <br />
    <label class="cf_botLabel">{cf_tooltip2}</label>
  </div>
</div>
<!--end_cf_dropdown-->
<!--start_cf_checkbox-->
<div class="cf_item">
  <h3 class="cf_title"{cf_labeloptions}>{cf_labeltext}</h3>
  <div class="cf_fields">
    <cf_theoptions>
      <label for="{name}" class="cf_chkboxLabel cf_block">
      <input name="{name}" id="{name}" type="checkbox" class="cf_checkbox" value="{value}" />
      {title}</label>
    </cf_theoptions>
  </div>
  <label class="cf_botLabel">{cf_tooltip2}</label>
  <br />
  <label class="cf_leftLabel">{cf_slabel}</label>
</div>
<!--end_cf_checkbox-->
<!--start_cf_radiobutton-->
<div class="cf_item">
  <h3 class="cf_title"{cf_labeloptions}>{cf_labeltext}</h3>
  <div class="cf_fields">
    <cf_theoptions>
      <label for="{name}" class="cf_radioLabel cf_block">
      <input name="{cf_name}" id="{name}" type="radio" class="cf_radio" value="{value}" />
      {title}</label>
    </cf_theoptions>
  </div>
  <label class="cf_botLabel">{cf_tooltip2}</label>
  <br />
  <label class="cf_leftLabel">{cf_slabel}</label>
</div>
<!--end_cf_radiobutton-->
<!--start_cf_datetimepicker-->
<div class="cf_item">
  <h3 class="cf_title"{cf_labeloptions}>{cf_labeltext}</h3>
  <div class="cf_fields">
    <input name="{cf_name}" type="text" value="" class="cf_inputtext" size="{cf_size}" id="{cf_id}" />
    <br />
    <label class="cf_botLabel">{cf_tooltip2}</label>
  </div>
</div>
<!--end_cf_datetimepicker-->
<!--start_cf_fileupload-->
<div class="cf_item">
  <h3 class="cf_title"{cf_labeloptions}>{cf_labeltext}</h3>
  <div class="cf_fields">
    <input size="{cf_size}" id="{cf_id}" name="{cf_name}" type="file" class="cf_fileinput" />
    <br />
    <label class="cf_botLabel">{cf_tooltip2}</label>
    <br />
    <label class="cf_leftLabel">{cf_slabel}</label>
  </div>
</div>
<!--end_cf_fileupload-->
<!--start_cf_hidden-->
<input value="{cf_value}" id="{cf_id}" name="{cf_name}" type="hidden" />
<!--end_cf_hidden-->
<!--start_cf_captcha-->
<div class="cf_item">
  <h3 class="cf_title"{cf_labeloptions}>{cf_labeltext}</h3>
  <div class="cf_fields"> <span>{imageverification}</span><br />
    <label class="cf_botLabel">{cf_tooltip2}</label>
    <br />
  </div>
</div>
<!--end_cf_captcha-->
<!--start_cf_button-->
<div class="cf_item">
  <input value="{cf_value}" name="{cf_name}" type="submit" />
</div>
<!--end_cf_button-->
