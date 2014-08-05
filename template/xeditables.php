        <div class="page-title">
          <h1>
            X-Editable Forms
          </h1>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <form action="http://sharpandnimble.com/se7en/demo/xeditable.html" class="form-horizontal" id="frm" method="get">
              <div class="form-group" style="margin-bottom:5px">
                <label class="control-label pull-left" style="text-align:left; margin-right:15px;">Mode</label><select class="form-control pull-left" id="c" name="c" style="width:150px; margin-right:8px;"><option value="popup">Popover</option><option value="inline">Inline</option></select><button class="btn btn-primary" type="submit">Refresh</button>
              </div>
            </form>
          </div>
          <div class="col-lg-6">
            <div style="float: right;">
              <label style="margin-right: 30px;"><input id="autoopen" type="checkbox"><span>Auto open next field</span></label><button class="btn btn-default" id="enable" style="margin:0;">Enable / Disable</button>
            </div>
          </div>
        </div>
        <div class="row" style="margin-top: 0">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="widget-content padded">
                <p>
                  <em>Click fields below to edit</em>
                </p>
                <table class="table table-bordered table-striped editable-form" id="user" style="clear: both">
                  <tbody>
                    <tr>
                      <td width="35%">
                        Simple text field
                      </td>
                      <td>
                        <a data-original-title="Enter username" data-pk="1" data-type="text" href="#" id="username">Username</a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Empty text field, required
                      </td>
                      <td>
                        <a data-original-title="Enter your firstname" data-pk="1" data-placeholder="Required" data-placement="right" data-type="text" href="#" id="firstname"></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Select, local array, custom display
                      </td>
                      <td>
                        <a data-original-title="Select sex" data-pk="1" data-type="select" data-value="" href="#" id="sex"></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Select, remote array, no buttons
                      </td>
                      <td>
                        <a data-original-title="Select group" data-pk="1" data-source="/groups" data-type="select" data-value="5" href="#" id="group">Admin</a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Select, error while loading
                      </td>
                      <td>
                        <a data-original-title="Select status" data-pk="1" data-source="/status" data-type="select" data-value="0" href="#" id="status">Active</a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Combodate (date)
                      </td>
                      <td>
                        <a data-format="YYYY-MM-DD" data-original-title="Select Date of birth" data-pk="1" data-template="D / MMM / YYYY" data-type="combodate" data-value="1984-05-15" data-viewformat="DD/MM/YYYY" href="#" id="dob"></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Combodate (datetime)
                      </td>
                      <td>
                        <a data-format="YYYY-MM-DD HH:mm" data-original-title="Setup event date and time" data-pk="1" data-template="D MMM YYYY  HH:mm" data-type="combodate" data-viewformat="MMM D, YYYY, HH:mm" href="#" id="event"></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Textarea, buttons below. Submit by <i>ctrl+enter</i>
                      </td>
                      <td>
                        <a data-original-title="Enter comments" data-pk="1" data-placeholder="Your comments here..." data-type="textarea" href="#" id="comments">awesomeuser!</a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Checklist
                      </td>
                      <td>
                        <a data-original-title="Select fruits" data-type="checklist" data-value="2,3" href="#" id="fruits"></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Select2 (tags mode)
                      </td>
                      <td>
                        <a data-original-title="Enter tags" data-pk="1" data-type="select2" href="#" id="tags"></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Select2 (dropdown mode)
                      </td>
                      <td>
                        <a data-original-title="Select country" data-pk="1" data-type="select2" data-value="BS" href="#" id="country"></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Custom input, several fields
                      </td>
                      <td>
                        <a data-original-title="Please, fill address" data-pk="1" data-type="address" href="#" id="address"></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>