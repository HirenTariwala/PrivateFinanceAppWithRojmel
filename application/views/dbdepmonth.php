
<div class="form-group">
                                        <label class="control-label">Month No</label>
                                        <select name="depDrawMonth" id="selector1" class="form-control">
                                            <?php 
                                            myterm($record[0]->month,$record[0]->year,$record[0]->drawterm);

                                            ?>
                                            
                                        </select>
                                       
                                    </div>
