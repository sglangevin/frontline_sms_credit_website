<!--start_cf_text-->
<div class="form_item">
  <div class="form_element cf_text"> <span class="{cf_class}">{cf_labeltext}</span> </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_text-->
<!--start_cf_placeholder-->
<div class="form_item">
  <div class="form_element cf_placeholder">{cf_codeplace}</div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_placeholder-->
<!--start_cf_multiholder-->
<div class="form_item">
  <div class="form_element cf_multiholder" style="margin-left:0px!important;">
  	<label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
    <table cellspacing="0" cellpadding="0" width="95%" title="" class="multi_container">
        <tbody width="100%">
            <tr width="100%">
                <cf_thecells><td style="width: auto; vertical-align: middle; text-align: left;">{element}</td></cf_thecells>
            </tr>
        </tbody>
    </table>
  </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_multiholder-->
<!--start_cf_heading-->
<div class="form_item">
  <div class="form_element cf_heading">
    <{cf_tag} class="{cf_class}">{cf_labeltext}</{cf_tag}>
  </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_heading-->
<!--start_cf_textbox-->
<div class="form_item">
  <div class="form_element cf_textbox">
    <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
    <input class="{cf_class}" maxlength="{cf_maxlength}" size="{cf_size}" title="{cf_title}" id="{cf_id}" name="{cf_name}" type="{cf_type}" />
  {cf_tooltip}
  </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_textbox-->
<!--start_cf_password-->
<div class="form_item">
  <div class="form_element cf_password">
    <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
    <input class="{cf_class}" maxlength="{cf_maxlength}" size="{cf_size}" title="{cf_title}" id="{cf_id}" name="{cf_name}" type="{cf_type}" />
    {cf_tooltip}
  </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_password-->
<!--start_cf_textarea-->
<div class="form_item">
  <div class="form_element cf_textarea">
    <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
    <textarea class="{cf_class}" rows="{cf_rows}" id="{cf_id}" title="{cf_title}" cols="{cf_cols}" name="{cf_name}"></textarea>
    {cf_tooltip}
  </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_textarea-->
<!--start_cf_dropdown-->
<div class="form_item">
  <div class="form_element cf_dropdown">
    <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
    <select class="{cf_class}" id="{cf_id}" size="{cf_size}" title="{cf_title}" {cf_multiple} name="{cf_name}">
    <option value="">Choose Option</option>
      <cf_theoptions><option value="{value}">{title}</option></cf_theoptions>
    </select>
    {cf_tooltip}
  </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_dropdown-->
<!--start_cf_checkbox-->
<div class="form_item">
  <div class="form_element cf_checkbox">
    <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
    <div class="float_left">
      <cf_theoptions><input value="{value}" title="{cf_title}" class="{cf_class}" id="{name}" name="{cf_name}" type="checkbox" />
      <label for="{name}" class="check_label">{title}</label>
      <br />
      </cf_theoptions>
    </div>
    {cf_tooltip}
  </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_checkbox-->
<!--start_cf_radiobutton-->
<div class="form_item">
  <div class="form_element cf_radiobutton">
    <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
    <div class="float_left">
      <cf_theoptions><input value="{value}" title="{cf_title}" class="{cf_class}" id="{name}" name="{cf_name}" type="radio" />
      <label for="{name}" class="radio_label">{title}</label>
      <br />
      </cf_theoptions>
    </div>
    {cf_tooltip}
  </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_radiobutton-->
<!--start_cf_datetimepicker-->
<div class="form_item">
  <div class="form_element cf_datetimepicker">
    <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
    <input class="{cf_class}" title="{cf_title}" size="{cf_size}" id="{cf_id}" name="{cf_name}" type="{cf_type}" />
    {cf_tooltip}
  </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_datetimepicker-->
<!--start_cf_fileupload-->
<div class="form_item">
  <div class="form_element cf_fileupload">
    <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
    <input class="cf_fileinput {cf_class}" title="{cf_title}" size="{cf_size}" id="{cf_id}" name="{cf_name}" type="file" />
    {cf_tooltip}
  </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_fileupload-->
<!--start_cf_hidden-->
<input value="{cf_value}" id="{cf_id}" name="{cf_name}" type="hidden" />
<!--end_cf_hidden-->
<!--start_cf_captcha-->
<div class="form_item">
  <div class="form_element cf_captcha">
    <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
    <span>{imageverification}</span> 
    {cf_tooltip}
    </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_captcha-->
<!--start_cf_button-->
<div class="form_item">
  <div class="form_element cf_button">
    <input value="{cf_value}" name="{cf_name}" type="submit" />{cf_resetbutton}
  </div>
  <div class="cfclear">&nbsp;</div>
</div>
<!--end_cf_button-->