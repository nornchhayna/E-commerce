@extends('customer.layouts.app')

@section('title', 'About Us')

@section('content')
    <div class="about-us-container">
        <style>
            /* Base Styles */
            .about-us-container {
                background-color: #ffffff;
                /* border-radius: 0.75rem;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); */
                overflow: hidden;
                max-width: 80rem;
                margin: 2rem auto;
                transition: box-shadow 0.3s ease;
            }

            /* .about-us-container:hover {
                    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
                } */

            /* Header */
            .about-header {
                background-color: #f9fafb;
                color: #374151;
                padding: 3rem 2rem;
                text-align: center;
            }

            .about-header h1 {
                font-size: 2.25rem;
                font-weight: 700;
                color: #1f2937;
                margin-bottom: 0.5rem;
            }

            .about-header p {
                font-size: 1.25rem;
                color: #6b7280;
                max-width: 32rem;
                margin: 0 auto;
            }

            /* Content */
            .about-content {
                padding: 2rem 2rem;
            }

            .about-content .prose {
                max-width: 64rem;
                margin: 0 auto;
            }

            .about-content h2 {
                font-size: 1.5rem;
                font-weight: 600;
                color: #1f2937;
                margin-top: 2rem;
                margin-bottom: 1rem;
            }

            .about-content p {
                font-size: 1rem;
                color: #4b5563;
                line-height: 1.6;
                margin-bottom: 1rem;
            }

            .about-content ul {
                list-style: disc;
                padding-left: 1.5rem;
                margin-bottom: 1rem;
            }

            .about-content ul li {
                color: #4b5563;
                margin-bottom: 0.5rem;
            }

            .about-content ul li strong {
                color: #1f2937;
            }

            /* Stats Section */
            .stats-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin-top: 2rem;
            }

            @media (min-width: 768px) {
                .stats-grid {
                    grid-template-columns: repeat(3, 1fr);
                }
            }

            .stats-item {
                text-align: center;
            }

            .stats-item .number {
                font-size: 2.25rem;
                font-weight: 700;
                color: #4b5563;
                margin-bottom: 0.5rem;
            }

            .stats-item .label {
                font-size: 0.875rem;
                color: #6b7280;
            }

            /* Team Section */
            .team-section {
                margin-top: 2rem;
                padding: 1rem;
                background-color: #f9fafb;
                border-radius: 0.5rem;
            }

            .team-section h2 {
                font-size: 1.5rem;
                font-weight: 600;
                color: #1f2937;
                margin-bottom: 1rem;
            }

            .team-section p {
                font-size: 1rem;
                color: #4b5563;
                line-height: 1.6;
            }

            /* Responsive Design */
            @media (max-width: 767px) {
                .about-header {
                    padding: 2rem 1rem;
                }

                .about-header h1 {
                    font-size: 1.75rem;
                }

                .about-header p {
                    font-size: 1rem;
                }

                .about-content {
                    padding: 1.5rem 1rem;
                }

                .about-content h2 {
                    font-size: 1.25rem;
                }

                .about-content p {
                    font-size: 0.875rem;
                }

                .stats-grid {
                    gap: 1rem;
                }

                .stats-item .number {
                    font-size: 1.5rem;
                }

                .stats-item .label {
                    font-size: 0.75rem;
                }
            }
        </style>

        <div class="about-header">
            <h1>About Our Company</h1>
            <p>Discover our story and what makes us different</p>
        </div>

        <div class="about-content">
            <div class="prose">
                <h2>Our Story</h2>
                <p>Founded in 2023 by a team passionate about technology and customer satisfaction, our company began with a
                    vision to deliver high-quality products at affordable prices. Spearheaded by students like Norn Chhayna,
                    a third-year Computer Science student at NPIC University, our team blends academic insights with
                    practical innovation to shape our platform.</p>

                <h2 class="mt-8">Our Mission</h2>
                <p>We strive to make online shopping effortless, enjoyable, and accessible to all. Our dedicated team,
                    including contributors from diverse backgrounds, works tirelessly to curate top-tier products and ensure
                    a seamless experience, leveraging skills honed in fields like software development and digital design.
                </p>

                <h2 class="mt-8">Our Values</h2>
                <ul>
                    <li><strong>Customer First:</strong> Your satisfaction drives our every decision</li>
                    <li><strong>Quality Assurance:</strong> Every item is meticulously selected for excellence</li>
                    <li><strong>Transparency:</strong> Clear pricing and open communication</li>
                    <li><strong>Innovation:</strong> Continuously enhancing our platform with cutting-edge solutions</li>
                </ul>

                <div class="stats-grid">
                    <div class="stats-item">
                        <div class="number">1000+</div>
                        <div class="label">Happy Customers</div>
                    </div>
                    <div class="stats-item">
                        <div class="number">500+</div>
                        <div class="label">Quality Products</div>
                    </div>
                    <div class="stats-item">
                        <div class="number">24/7</div>
                        <div class="label">Customer Support</div>
                    </div>
                </div>

                <div class="team-section">
                    <h2>Meet Our Team</h2>
                    <p>Our team includes talented individuals like Norn Chhayna, who brings a fresh perspective from NPIC
                        University’s Computer Science program. With a focus on user-friendly design and robust backend
                        development, we’re committed to building a platform that reflects both technical expertise and a
                        passion for e-commerce.</p>
                </div>
            </div>
        </div>
    </div>
@endsection