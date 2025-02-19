<?php
$cta = get_field('cta');
$cta_text = $cta['title'] ?? 'Get Instant Quote';
$cta_url = $cta['url'] ?? '#';
?>
<section class="pricing_table pt-4 pb-5">
    <div class="container-xl">
        <div class="pricing_table__inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Features</th>
                            <th>Essential<br>Protection</th>
                            <th>Automated<br>Monitoring</th>
                            <th>
                                <div class="pill">Recommended Plan</div>
                                24/7 Emergency<br>Response
                            </th>
                            <th>Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Personal Safety Mobile App & Safety Dashboard</td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Company designated monitors</td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Location Tracking</td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Person down alerts</td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Incident Reporting</td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>End of Shift &amp; Check-in reminders</td>
                            <td><i class="fa-solid fa-minus"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Out of hours alerts</td>
                            <td><i class="fa-solid fa-minus"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Automated alarm escalation</td>
                            <td><i class="fa-solid fa-minus"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>24/7 Safety Monitoring Center</td>
                            <td><i class="fa-solid fa-minus"></i></td>
                            <td><i class="fa-solid fa-minus"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Emergency response</td>
                            <td><i class="fa-solid fa-minus"></i></td>
                            <td><i class="fa-solid fa-minus"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <th class="pt-4">Business plus add-on</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>API Integration</td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Satellite devices</td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Enhanced GPS location tracking</td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Monitor access levels</td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                        <tr>
                            <td>Scheduled reports</td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                            <td><i class="fa-solid fa-check"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="<?= esc_url($cta_url) ?>" class="button button-yellow d-block"><span><?= esc_html($cta_text) ?></span></a>
        </div>
    </div>
</section>