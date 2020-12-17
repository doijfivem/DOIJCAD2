var auto_refresh = setInterval( function () {
										///////////// PANIC API
										let resp1 = `<?php if (getPanicStatus()['status'] == true) {
											?>
												<script>
													var audio = new Audio('../assets/audio/panicActivate.mp3');
													audio.volume = 0.2;
													audio.play();
												</script>
												<ul id="buttons14" class="buttons">
													<li>
														<a class="button n01"><svg><use xlink:href="../assets/icons.svg#location"></use></svg><span class="label">Panic Button Pressed By: &#39;<?php echo getPanicStatus()['name']; ?>&#39;</span></a>
													</li>
												</ul>
											<?php
											}
											?>`
										$("#panicAPI").html(resp1);
										
										///////////// CALL TABLE
										<?php 
										$sql2 = "SELECT * from calls WHERE closed = 0 AND server = $serverPass";
										$count2 = 1;
										$result2 = mysqli_query($conn, $sql2);
										?>
										let resp2 = `<?php if (mysqli_num_rows($result2) > 0) {
											?>
												<div id="table06" class="table-wrapper">
													<div class="table-inner">
													<table>
													<thead>
														<tr>
															<th>ID</th>
															<th>Primary Unit</th>
															<th>Call Type</th>
															<th>Location</th>
														</tr>
													</thead>
													<tbody>
											<?php
												while ($rowActCalls = mysqli_fetch_assoc($result2)) {
											?>
													
													<tr>
														<td><a href="<?php echo $url; ?>&ext=<?php echo $rowActCalls['id']; ?>">#<?php echo $rowActCalls['id']; ?></a></td>
														<td><?php echo $rowActCalls['primaryName']; ?></td>
														<td><?php echo convertResultToColor($rowActCalls['callType']); ?></td>
														<td><?php echo $rowActCalls['location']; ?></td>
													</tr>
															
											
											<?php
													$count2++;
												}
											?>
													</tbody>
													</table>
													</div>
												</div>
											<?php
											} else {
											?>
												<p id="text03">There's no active calls.</p>
											<?php
											}?>`
										$("#callAPI").html(resp2);

										///////////// BOLO TABLE
										<?php 
										$sql3 = "SELECT * from bolos";
										$count3 = 1;
										$result3 = mysqli_query($conn, $sql3);
										?>
										let resp3 = `<?php if (mysqli_num_rows($result3) > 0) {
											
											?>
												<div id="table04" class="table-wrapper">
													<div class="table-inner">
														<table>
															<thead>
																<tr>
																	<th>Details</th>
																	<th>Date & Time Added</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody>
											
											<?php
																while ($rowCall = mysqli_fetch_assoc($result3)) {
											?>
																	<tr>
																		<td><?php echo $rowCall['details']; ?></td>
																		<td><?php echo $rowCall['date']; ?> <?php echo $rowCall['time']; ?></td>
																		<td><a href="?delbolo=<?php echo $rowCall['id']; ?>&r=<?php echo $unitId; ?>">Delete</td>
																	</tr>							
											<?php
																	$count3++;
																}
											?>
															</tbody>
														</table>
													</div>
												</div>
											<?php
											} else {
											?>
												<p id="text03">There is no current BOLO's</p>
											<?php
											}?>`
										$("#boloAPI").html(resp3);

										///////////// UNIT TABLE
										let resp4 = `<?php
										$sql4 = "SELECT * from emerg WHERE NOT status = '10-7' AND server = $serverPass";
										$count4 = 1;
										$result4 = mysqli_query($conn, $sql4);
										?><div id="table08" class="table-wrapper">
												<div class="table-inner">
													<table>
														<thead>
															<tr>
																<th class="tableWhiteOverride">Unit</th>
																<th class="tableWhiteOverride">Status</th>
															</tr>
														</thead>
														<tbody>
															<?php
															if (mysqli_num_rows($result4) > 0) {
																while ($rowUnits = mysqli_fetch_assoc($result4)) {
															?>
																<tr>
																	<td><span style="color: <?php getDeptColor($rowUnits['dept']); ?>"><?php echo $rowUnits['name']; ?></span></td>
																	<td><?php convertResultToColor($rowUnits['status']); ?></td>
																</tr>
															<?php
																	$count4++;
																}
															} else {
															?>
																<tr>
																	<td>No active units.</td>
																	<td></td>
																</tr>
															<?php
															}
															?>
														</tbody>
													</table>
												</div>
											</div>`

										$("#getUnitTable").html(resp4);
										// document.getElementById('getUnitTable').innerHTML = resp4;
										// $("h1").text(resp4)
										console.log('yo bitch')
										console.log(resp4)
									}, 4000);