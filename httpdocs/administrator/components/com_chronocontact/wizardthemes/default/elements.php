<!--start_cf_text-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_text"><span class="cf_text">{cf_labeltext}</span></div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
	<div class="clear"></div>
  </div>
<!--end_cf_text-->
<!--start_cf_placeholder-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_placeholder"><span class="cf_text">{cf_labeltext}</span></div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
	<div class="clear"></div>
  </div>
<!--end_cf_placeholder-->
<!--start_cf_multiholder-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_multiholder">
    	<label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
        <table cellspacing="3" cellpadding="3" width="65%" title="" class="multi_container">
            <tbody width="100%">
                <tr width="100%">
                	<cf_thecells><td style="width: auto; vertical-align: middle; text-align: center;">{value}</td></cf_thecells>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
	<div class="slabel" style="display:none;">{cf_slabel}</div>
    <div class="clear"></div>
  </div>
<!--end_cf_multiholder-->
<!--start_cf_heading-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_heading">
      <{cf_tag} class="cf_text">{cf_labeltext}</{cf_tag}>
    </div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
	<div class="clear"></div>
  </div>
<!--end_cf_heading-->
<!--start_cf_textbox-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_textbox">
      <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
      <input type="text" name="{cf_name}" id="{cf_id}" size="{cf_size}" maxlength="{cf_maxlength}" title="{cf_title}" class="{cf_class}"/>
      {cf_tooltip}
    </div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
    <div class="slabel" style="display:none;">{cf_slabel}</div>
	<div class="clear"></div>
  </div>
<!--end_cf_textbox-->
<!--start_cf_password-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_password">
      <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
      <input type="password" name="{cf_name}" id="{cf_id}" size="{cf_size}" title="{cf_title}" maxlength="{cf_maxlength}" class="{cf_class}"/>
      {cf_tooltip}
    </div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
    <div class="slabel" style="display:none;">{cf_slabel}</div>
	<div class="clear"></div>
  </div>
<!--end_cf_password-->
<!--start_cf_textarea-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_textarea">
      <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
      <textarea name="{cf_name}" cols="{cf_cols}" id="{cf_id}" rows="{cf_rows}" title="{cf_title}" class="{cf_class}" ></textarea>
      {cf_tooltip}
    </div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
    <div class="slabel" style="display:none;">{cf_slabel}</div>
	<div class="clear"></div>
  </div>
<!--end_cf_textarea-->
<!--start_cf_dropdown-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_dropdown">
      <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
      <select class="{cf_class}" id="{cf_id}" size="{cf_size}" title="{cf_title}" {cf_multiple} name="{cf_name}">
      <cf_theoptions><option value="{value}">{title}</option></cf_theoptions>
    </select>
    {cf_tooltip}
    </div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
    <div class="slabel" style="display:none;">{cf_slabel}</div>
	<div class="clear"></div>
  </div>
<!--end_cf_dropdown-->
<!--start_cf_checkbox-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_checkbox">
      <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
      <div class="float_left" title="{cf_title}">
        <cf_theoptions><input value="{value}" class="{cf_class}" id="{name}" name="{cf_name}" type="checkbox" />
        <label for="{name}" class="check_label">{title}</label>
        <br />
        </cf_theoptions>
      </div>
      {cf_tooltip}
    </div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
    <div class="slabel" style="display:none;">{cf_slabel}</div>
	<div class="clear"></div>
  </div>
<!--end_cf_checkbox-->
<!--start_cf_radiobutton-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255); visibility: visible; opacity: 1;">
    <div class="form_element cf_radiobutton">
      <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
      <div class="float_left" title="{cf_title}">
        <cf_theoptions><input value="{value}" class="{cf_class}" id="{name}" name="{cf_name}" type="radio" />
      <label for="{name}" class="radio_label">{title}</label>
      <br />
      </cf_theoptions>
      </div>
      {cf_tooltip}
    </div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
    <div class="slabel" style="display:none;">{cf_slabel}</div>
	<div class="clear"></div>
  </div>
<!--end_cf_radiobutton-->
<!--start_cf_datetimepicker-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_datetimepicker">
      <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
      <input type="text" size="{cf_size}" id="{cf_id}" name="{cf_name}" title="{cf_title}" class="{cf_class}"/>
      {cf_tooltip}
    </div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
    <div class="slabel" style="display:none;">{cf_slabel}</div>
	<div class="clear"></div>
  </div>
<!--end_cf_datetimepicker-->
<!--start_cf_fileupload-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_fileupload">
      <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
      <input type="file" size="{cf_size}" id="{cf_id}" name="{cf_name}" title="{cf_title}" class="{cf_class}"/>
      {cf_tooltip}
    </div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
    <div class="slabel" style="display:none;">{cf_slabel}</div>
	<div class="clear"></div>
  </div>
<!--end_cf_fileupload-->
<!--start_cf_hidden-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_hidden">
      <label class="cf_label">Hidden field</label>
      <input type="hidden" id="{cf_id}" name="{cf_name}" value="{cf_value}"/>
    </div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
	<div class="clear"></div>
  </div>
<!--end_cf_hidden-->
<!--start_cf_captcha-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_captcha">
      <label class="cf_label"{cf_labeloptions}>{cf_labeltext}</label>
      <span>{imageverification}</span>
      {cf_tooltip}
    </div>      
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
	<div class="clear"></div>
  </div>
<!--end_cf_captcha-->
<!--start_cf_button-->
<div class="form_item" style="border: 0px solid rgb(0, 0, 0); background-color: rgb(255, 255, 255);">
    <div class="form_element cf_button">
      <input type="button" name="{cf_name}" value="{cf_value}"/>{cf_resetbutton}
    </div>
    <div class="delete_icon" style="display: none;"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/icon_delete.gif"/></div>
    <div class="config_icon"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/config.png"/><span style="cursor: move; height: auto; width: 15px;" class="drag"><img height="15" width="15" alt="delete" src="components/com_chronocontact/css/images/sort.png"/></span></div>
	<div class="clear"></div>
  </div>
<!--end_cf_button-->