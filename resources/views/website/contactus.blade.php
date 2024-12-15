<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Contact Us - Chantilly Schools" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-menu active="contactus"/>

    {{-- BODY STARTS HERE  --}}

    <!--Contact Area Strat-->
    <div class="contact-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-area-container">
                        <div class="single-title">
                            <h3>Contact Info</h3>
                        </div>
                        <p>Chantilly Schools is all about maximizing the potential of each student, through continuous improvement <b>"Kaizen"</b>. We apply this philosophy in all areas.</p>
                        <div class="contact-address-container">
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Address</h4>
                                    <span>P.O Box 711, Karuri, Kenya</span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Phone</h4>
                                    <span><a href="tel:0714402822">(254) 714 402 822</a></span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-whatsapp"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>WhatsApp Message</h4>
                                    <span><a target="_blank" href="https://wa.link/2xe379">Click me to send a message to (254) 714 402 822</a></span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Email</h4>
                                    <span>info@chantillyschools.ac.ke</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-form">
                        <div class="single-title">
                            <h3>Send Us A Message</h3>
                        </div>
                        <div class="contact-form-container">
                            <form id="contact-form" action="#" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="name" placeholder="Your Name *">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="email" placeholder="Your Email *">
                                    </div>
                                </div>
                                <input type="text" name="subject" placeholder="Subject (What are you inquiring about?) *">
                                <textarea name="message" class="yourmessage" placeholder="Your message here (We will get back to you ASAP)"></textarea>
                                <button type="submit" class="button-default button-yellow submit"><i class="fa fa-send"></i>Submit</button>
                            </form>
                            <p class="form-messege"></p>
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
