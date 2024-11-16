<!DOCTYPE html>
<html lang="en">
{{-- header title favicon etc --}}
<x-header title="Vacancies - Chantilly Schools" />

<body>
    {{-- mobile menu and desktop menu --}}
    <x-menu active="vacancy"/>

    {{-- BODY STARTS HERE --}}
    <!--Contact Area Strat-->
    <div class="contact-area section-padding">
        <div class="container">
            <div class="single-title text-center">
                <h3>Apply : "School-Based Mental Health Counsellor"</h3>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-form">
                        <div class="single-title">
                            <h3>Apply Here</h3>
                        </div>
                        <div class="contact-form-container">
                            <form id="contact-form" action="#" method="post">
                                <input type="text" name="fullname" placeholder="Your Fullname *" required>
                                <input type="email" name="email" placeholder="Your Email *" required>
                                <input type="text" name="phonenumber" placeholder="Your Phone Number *" required>
                                <select name="marital_status" required>
                                    <option value="" hidden>Marital Status *</option>
                                    <option value="married">Married</option>
                                    <option value="single">Single</option>
                                </select>
                                <input type="date" max="{{date("Y-m-d", strtotime("-18 years"))}}" name="date_of_birth" placeholder="Date of Birth *" required>
                                <textarea name="message" class="yourmessage" placeholder="Your message" required></textarea>
                                <label for="">Your CV</label>
                                <input type="file" accept=".pdf, .docx, .doc" name="cv" placeholder="Your CV *" required>
                                <button type="submit" class="button-default button-yellow submit"><i class="fa fa-send"></i>Submit</button>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-area-container">
                        <div class="single-title">
                            <h3>Job Description</h3>
                        </div>
                        <div class="contact-address-container">
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-certificate"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Nature & Scope</h4>
                                    <span>To provide school-based counselling and assessment services to students (Preschool-12)
                                        that will facilitate positive growth in students whose behavioral/emotional issues are
                                        affecting their academic or social performance at school. To provide consultation to
                                        teachers, administrators, and parents and to design and implement a counselling program
                                        that facilitates positive growth and change in the social, emotional, and physical thinking
                                        and behaviour of students that leads to the development of God-given gifts for Christ-like
                                        service in the world community</span>
                                </div>
                            </div>
                            <div class="contact-address-info">
                                <div class="contact-icon">
                                    <i class="fa fa-certificate"></i>
                                </div>
                                <div class="contact-text">
                                    <h4>Qualification</h4>
                                    <span>
                                        <ol type="1">
                                            <li>A personal commitment to Jesus Christ as Savior and Lord.</li>
                                            <li>Exhibit a continuing sense of God’s calling to service at Chantilly Schools.</li>
                                            <li>Demonstrate a respect for diversity of culture, religion, and different Christian traditions.</li>
                                            <li>Demonstrate an appreciation for the diversity of the body of Christ.</li>
                                            <li>Possess a minimum of a Master’s Degree in counselling from a North American accredited tertiary body.</li>
                                            <li>Hold a counselling certificate from an authorized governmental agency from the individual’s home country and an ability to pursue certification as a counselor in Kenya.</li>
                                            <li>Show evidence of recent professional growth.</li>
                                            <li>Demonstrate knowledge and understanding of child development and an ability to integrate an understanding of Christian personhood with counseling theories.</li>
                                            <li>Demonstrate the ability to communicate effectively in English, both orally and in writing.</li>
                                        </ol>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Contact Area-->
    {{-- BODY ENDS HERE --}}

    {{-- FOOTER --}}
    <x-footer page="vacancies"/>
</body>

</html>
