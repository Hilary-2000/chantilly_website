<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Term and Conditions - Chantilly Schools" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-menu active="contactus" />

    {{-- BODY STARTS HERE  --}}

    <!--Contact Area Strat-->
    <div class="contact-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-info">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success py-1 text-center my-1">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-info py-1 text-center my-1">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                {{-- <div class="col-lg-3">
                    <div class="single-title">
                        <h3>Menu</h3>
                    </div>
                    <div class="contact-area-container">
                        <p>Chantilly Schools is all about maximizing the potential of each student, through continuous
                            improvement <b>"Kaizen"</b>. We apply this philosophy in all areas.</p>
                        <div class="contact-address-container">
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-12">
                    <div class="contact-form">
                        <div class="single-title">
                            <h3>Terms And Conditions</h3>
                        </div>
                        <div class="contact-form-container">
                            <h6>1. Introductions</h6>
                            <p>Thank you for using the Chantilly School website (accessible at
                                www.chantillyschools.ac.ke hereinafter, “the website”) owned, managed, maintained and operated
                                by Chantilly Schools.

                                This page states the terms and conditions under which you may use the website and any
                                other materials, online communications and other information that is or becomes
                                available on the website. By accessing the website, you accept and agree to be bound,
                                without limitations or qualification by these terms. If you do not accept any of the
                                terms stated here, do not use the website.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>2. Agreement between you and Chantilly Schools</h6>
                            <p>
                                The website is owned, managed, maintained and operated by Chantilly Schools (hereinafter Chantilly) and is offered to you conditioned on your acceptance without modification of these terms, conditions disclaimers and notices contained herein. Use of the content, services and/or products and services presented in any and all areas of this site constitutes your agreement that you will not use the website for any unlawful purpose and that you will abide by the following terms and conditions and those posted on specific areas of the site. This agreement between you and Chantilly (hereinafter “Agreement”) is effective until terminated by Chantilly, and maybe terminated or changed by Chantilly at any time without notice.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>3. Your obligations</h6>
                            <p>In connection with your use of the website, you shall abide by all applicable laws, local or international including those pertaining to such areas as libel, slander, defamation, trade libel, product disparagement, harassment, invasion of privacy, tort, obscenity, indecency and copyright or trademark infringement. You are responsible for the content of any information that you put on the website or you submit to Chantilly for onward posting on the website. You agree that no materials of any kind submitted to the website or Chantilly by you will violate or infringe upon the rights of any third party, including copyright, trademark, privacy or other personal or proprietary rights, or contain libelous, defamatory or otherwise unlawful materials or be harmful to minors in any way. Chantilly reserves the right to refuse to post or to remove any information that is in Chantilly sole discretion, unacceptable, undesirable or in violation of these rules. However, Chantilly has no obligation to exercise such reservation of rights by Chantilly.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>4. General disclaimer</h6>
                            <p>The information included on the website is provided free of charge as a user convenience and is to be used for informational purposes only. Some information contained on the website may represent opinion or judgment or contain inadvertent technical oversights, factual inaccuracies or typographical errors.Chantilly does not guarantee the accuracy or completeness of any information on the website. As such, Chantilly will not be responsible for any errors, inaccuracies, omissions or deficiencies in the information provided on the website. This information is provided as “AS IS” with no guarantees of completeness, non-infringement, accuracy or timeliness, and without warranties of any kind, express or implied. You therefore assume sole responsibility for all risks associated with the use of this information and further accept that Chantilly is in no way responsible for any consequences whatsoever to anyone arising from your use or interpretation of any information contained within or linked from or to the website. Before making decisions based on the information contained here, we strongly recommend that you visit the companies, institutions and/or individuals to ascertain the truth.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>5. Use of the website information at your own risk</h6>
                            <p>The website may contain information or materials from various information sources. Chantilly does not represent or endorse the accuracy or reliability of any information or materials provided by these sources. Reliance upon any such information or material shall also be at our own risk. Neither Chantilly nor its affiliates, partners, officers, directors, employees, subsidiaries, or agents shall be liable to you or anyone else for any inaccuracy, error, omission, interruption, timeliness, completeness, deletion, defect, failure of performance, computer virus, communication line failure, alteration of, or use of any content herein, regardless of cause, or for any damages resulting therefrom.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>6. Copyright policy</h6>
                            <p>All content provided on the website is owned by or licensed to Chantilly and/or our affiliates, associated companies, partners, officers, and/or agents and is protected by the Kenyan and International copyright laws. Chantilly and its licensors, affiliates, associated companies, partners, officers, and/or agents retain all proprietary rights to the content on the website. The content may not be reproduced, transmitted or distributed without the prior written permission of Chantilly.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>7. Trademarks</h6>
                            <p>All Chantilly’s trademarks, service marks, trade names, logos, coats of arms, and graphics (“Marks”) indicated on the website are registered trademarks, coats of arms and/or generally intellectual properties. You shall not make use of any of these trademarks without the prior written permission of Chantilly.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>7. Limitation on liability</h6>
                            <p>Under no circumstances shall Chantilly or any of its affiliates, partners, officers, directors, employees, subsidiaries or agents be held liable for any damages, whether direct, incidental, indirect, special or consequential damages, including, without limitation, lost use, data, revenues, time, money, profits or goodwill arising from or in connection with the use, reliance on, or performance of the information on the website, even when Chantilly has been advised of the possibility of such damages. Chantilly shall not be liable for damages or injury caused in whole or in part, whether foreseeable or unforeseeable, and whether based on tort (including defamation, contract, strict liability or otherwise in producing and publishing this website or any information contained on the website or linked by or to this website. If you are dissatisfied with any of the website’s terms and conditions, your sole and exclusive remedy is to discontinue using the website.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>8. Indemnity</h6>
                            <p>As a condition of use of the website, you agree to indemnify Chantilly and its affiliates, partners, officers, directors, employees, subsidiaries and agents from and against any and all liabilities, expenses (including Advocates’ fees) and damages arising out of any and all claims resulting from your use of the website and the materials (including software) thereon, including, without limitation any claims alleging facts that if true would constitute a breach by you of these Terms of Use. This indemnity shall include, without limitation, any claim, inaccuracy or defamation based on materials that you submit for use on the website.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>9. Third-party websites</h6>
                            <p>The website may contain links to third-party websites maintained by our affiliates, associated institutions, service providers, and other companies that are not affiliates of ours. We may also provide links that are solely meant to assist users in locating resources that maybe of interest to them. You assume sole responsibility and risk for your use of links to third-party websites. Chantilly does not represent or endorse the accuracy or reliability of any of the information, content or advertisements contained on, distributed through or linked, downloaded or accessed from any of the services contained on these third-party websites. No reference or link to a third-party or third-party website shall constitute and endorsement of such third-party or such third-party websites.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>10. Specific Disclaimers of Warranties</h6>
                            <p>All materials and services in this Website, including those provided by links to third-party websites are provided “as is” without warranty of any kind.The content published on this Website may include inaccuracies or typographical errors. Changes are periodically made to the information herein. Chantilly makes no representations and, to the fullest extent allowed by law, disclaims all warranties, express or implied, including but not limited to warranties of non-infringement, merchantability and fitness for a particular purpose regarding the suitability of the information; the accuracy, reliability, completeness or timeliness of the content, services, products, text, graphics, links or other items contained within the Website, or the results obtained from accessing and using this Website and/or the content contained herein. Chantilly does not warrant that the functions contained in the materials will be uninterrupted or error-free, that this Website, including the server that makes it available, are free of viruses or other harmful components. In addition, Chantilly shall not be liable to you or anyone else for any loss or injury caused in whole or in part by contingencies beyond its control in procuring, compiling, interpreting, reporting or delivering the service and information through the Website and you assume the entire cost of all necessary maintenance, repair or correction arising from any such loss or injury.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>11. Modification</h6>
                            <p>Chantilly shall have the right, at its sole discretion, to make improvements and/or changes in any aspect of the website at any time and does not accept any responsibility for the effects these alterations may have. Chantilly also reserves the right to change, modify, add or remove terms of this agreement at any time without notice. You agree to review this agreement periodically since such changes, modifications, additions or deletions shall be effective immediately upon posting and your subsequent use after such posting shall be deemed to be acceptance by you of such changes, modifications or deletions.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>12. Miscellaneous</h6>
                            <p>This agreement shall be deemed to include all other notices, policies, disclaimers and other terms contained in this website; provided, however, that in the event of a conflict between such other terms and the terms of this agreement, the terms of this agreement shall control.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>13. Choice of law and jurisdiction</h6>
                            <p>Our website is operated from our head offices at Chantilly School, Banana Raini Rd, off Limuru Road (Ruaka, Karuri). These Terms of Use shall be governed by and construed in accordance with the laws of the Republic of Kenya without regard to any conflict of law provisions thereof. Any action related to these Terms of Use shall be brought only in the Law courts of Kenya and all parties waive any objection to the personal jurisdiction of and venue in such courts.</p>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="contact-form-container">
                            <h6>14. Contacts</h6>
                            <p>You may contact us if you have any questions about the Terms of Use, the practices of this Site, or your dealings with the Site by sending an e-mail to chantillyschools@gmail.com.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Contact Area-->
    {{-- BODY ENDS HERE --}}

    {{-- FOOTER --}}
    <x-footer page="aboutus" />
</body>

</html>
