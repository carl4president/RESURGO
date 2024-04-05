<div class="modal fade" id="interviewModal" tabindex="-1" role="dialog" aria-labelledby="interviewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="interviewModalLabel">Interview Invitation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action='interview_resend.php' method='post'>
                    <p>Dear <span id="applicantName" name="applicantname"></span>,</p>
                    <p>Congratulations! Your application for the position of <span id="interviewPosition" name="position"></span> has been shortlisted for an interview.</p>
                    <p>Interview details:</p>
                        <input type="hidden" id="applicantIdInput" name="applicantid">
                        <input type="hidden" id="applicantNameInput" name="applicantname">
                        <input type="hidden" id="interviewPositionInput" name="position">
                        <input type="hidden" id="interviewEmail" name="email">
                        <input type="hidden" id="applicantId" name="id">
                        <div class="form-group">
                            <label for="interview_date" class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-10">
                                <input type="date" id="interviewDate" class="form-control" name="interview_date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="interview_time" class="col-sm-2 control-label">Time</label>
                            <div class="col-sm-10">
                                <div class="bootstrap-timepicker">
                                  <input type="text" class="form-control timepicker" id="interviewTime" name="interview_time">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="interview_location" class="col-sm-2 control-label">Location:</label>
                              <div class="col-sm-10">
                                   <input type="text" id="interviewLocation" class="form-control" name="interview_location">
                              </div>
                        </div>
                    <p>Please be prepared, and feel free to contact Carl John Yasay through Facebook for any further details.</p>
                    <p>Best regards,<br>OLSHCO</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class='btn btn-success btn-sm btn-flat' type='submit' name='interview'><i class='fa fa-trash'></i> Send</button>
                </form>
            </div>
        </div>
    </div>
</div>