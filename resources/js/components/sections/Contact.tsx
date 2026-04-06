import { useState } from 'react';
import { useSettings } from '@/context/SettingsContext';
import { useStatsBySection } from '@/hooks';
import { useSubmitContact } from '@/hooks';
import { showToast } from '../CustomToaster';
import { 
  Mail, Phone, MapPin, Facebook, Twitter, Linkedin, Instagram,
  Send, Lock, Loader2
} from 'lucide-react';

export default function Contact() {
  const { settings, loading } = useSettings();
  const { data: stats } = useStatsBySection('contact');
  const submitContact = useSubmitContact();
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    subject: '',
    message: '',
    phone: ''
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    
    try {
      await submitContact.mutateAsync(formData);
      setFormData({ name: '', email: '', subject: '', message: '', phone: '' });
      showToast.success('Your message has been sent successfully! We will get back to you soon.');
    } catch (error) {
      showToast.error(error instanceof Error ? error.message : 'Failed to send message. Please try again.');
    }
  };

  const inputClasses = "w-full px-4 py-3 pl-12 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all text-gray-700 placeholder-gray-400";
  const labelClasses = "block text-sm font-medium text-gray-700 mb-2";

  return (
    <section id="contact" className="py-20 bg-gray-50">
      <div className="container mx-auto px-4">
        <div className="text-center mb-16" data-aos="fade-up">
          <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Contact</h2>
          <p className="text-gray-500 text-lg">Get in touch with us for your next project</p>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-12 gap-8" data-aos="fade-up" data-aos-delay="100">
          <div className="lg:col-span-5">
            <div className="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-8 text-white h-full">
              <div className="mb-8">
                <span className="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/20 text-blue-300 rounded-full text-sm font-medium mb-4">
                  Get In Touch
                </span>
                <h3 className="text-2xl font-bold mb-2">Let&apos;s Build Something Amazing</h3>
                <p className="text-slate-300">Ready to transform your ideas into reality? We&apos;d love to hear from you.</p>
              </div>

              <div className="space-y-6 mb-8">
                <div className="flex items-start gap-4">
                  <div className="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <Mail className="w-5 h-5" />
                  </div>
                  <div>
                    <p className="text-sm text-slate-400 mb-1">Email Us</p>
                    <a href={`mailto:${loading ? '' : settings?.company_email}`} className="text-white hover:text-blue-300 transition-colors">
                      {loading ? 'Loading...' : settings?.company_email}
                    </a>
                  </div>
                </div>

                <div className="flex items-start gap-4">
                  <div className="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <Phone className="w-5 h-5" />
                  </div>
                  <div>
                    <p className="text-sm text-slate-400 mb-1">Call Us</p>
                    <a href={`tel:${loading ? '' : settings?.company_phone?.replace(/\s/g, '')}`} className="text-white hover:text-blue-300 transition-colors">
                      {loading ? 'Loading...' : settings?.company_phone}
                    </a>
                  </div>
                </div>

                {settings?.company_address && (
                  <div className="flex items-start gap-4">
                    <div className="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
                      <MapPin className="w-5 h-5" />
                    </div>
                    <div>
                      <p className="text-sm text-slate-400 mb-1">Location</p>
                      <p className="text-white">{settings.company_address}</p>
                    </div>
                  </div>
                )}
              </div>

              <div className="grid grid-cols-3 gap-4 py-6 border-t border-b border-white/10 mb-8">
                {stats && stats.length > 0 ? (
                  stats.sort((a, b) => a.display_order - b.display_order).map((stat) => (
                    <div key={stat.id} className="text-center">
                      <p className="text-2xl font-bold text-blue-400">{stat.value}</p>
                      <p className="text-xs text-slate-400">{stat.label}</p>
                    </div>
                  ))
                ) : (
                  <>
                    <div className="text-center">
                      <p className="text-2xl font-bold text-blue-400">98%</p>
                      <p className="text-xs text-slate-400">Satisfaction</p>
                    </div>
                    <div className="text-center">
                      <p className="text-2xl font-bold text-blue-400">24/7</p>
                      <p className="text-xs text-slate-400">Support</p>
                    </div>
                    <div className="text-center">
                      <p className="text-2xl font-bold text-blue-400">3.2k</p>
                      <p className="text-xs text-slate-400">Projects</p>
                    </div>
                  </>
                )}
              </div>

              <div>
                <p className="text-sm text-slate-400 mb-3">Follow Us</p>
                <div className="flex gap-3">
                  <a href={settings?.facebook_url || '#'} aria-label="Facebook" className="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-blue-500 transition-colors">
                    <Facebook className="w-5 h-5" />
                  </a>
                  <a href={settings?.twitter_url || '#'} aria-label="Twitter" className="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-blue-500 transition-colors">
                    <Twitter className="w-5 h-5" />
                  </a>
                  <a href={settings?.linkedin_url || '#'} aria-label="LinkedIn" className="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-blue-500 transition-colors">
                    <Linkedin className="w-5 h-5" />
                  </a>
                  <a href={settings?.instagram_url || '#'} aria-label="Instagram" className="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-blue-500 transition-colors">
                    <Instagram className="w-5 h-5" />
                  </a>
                </div>
              </div>
            </div>
          </div>

          <div className="lg:col-span-7">
            <div className="bg-white rounded-2xl shadow-lg p-8 h-full">
              <div className="flex items-center gap-4 mb-8">
                <div className="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center">
                  <Send className="w-6 h-6 text-blue-600" />
                </div>
                <div>
                  <h4 className="text-xl font-bold text-gray-900">Send Us a Message</h4>
                  <p className="text-gray-500">Fill out the form and our team will respond within 24 hours.</p>
                </div>
              </div>

              <form onSubmit={handleSubmit} noValidate className="space-y-6">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div>
                    <label className={labelClasses}>Your Name *</label>
                    <input 
                      type="text" 
                      name="name" 
                      placeholder="John Doe" 
                      required 
                      value={formData.name}
                      onChange={handleChange}
                      className={inputClasses}
                    />
                  </div>

                  <div>
                    <label className={labelClasses}>Email Address *</label>
                    <input 
                      type="email" 
                      name="email" 
                      placeholder="john@example.com" 
                      required 
                      value={formData.email}
                      onChange={handleChange}
                      className={inputClasses}
                    />
                  </div>

                  <div>
                    <label className={labelClasses}>Phone Number</label>
                    <input 
                      type="tel" 
                      name="phone" 
                      placeholder="+92 300 1234567" 
                      value={formData.phone}
                      onChange={handleChange}
                      className={inputClasses}
                    />
                  </div>

                  <div>
                    <label className={labelClasses}>Subject</label>
                    <input 
                      type="text" 
                      name="subject" 
                      placeholder="How can we help?" 
                      value={formData.subject}
                      onChange={handleChange}
                      className={inputClasses}
                    />
                  </div>

                  <div className="md:col-span-2">
                    <label className={labelClasses}>Your Message *</label>
                    <textarea 
                      name="message" 
                      rows={5}
                      placeholder="Tell us about your project..." 
                      required 
                      value={formData.message}
                      onChange={handleChange}
                      className={`${inputClasses} resize-none`}
                    ></textarea>
                  </div>
                </div>

                <div className="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 pt-4 border-t border-gray-100">
                  <button 
                    type="submit" 
                    disabled={submitContact.isPending}
                    className="px-8 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
                  >
                    {submitContact.isPending ? (
                      <>
                        <Loader2 className="w-5 h-5 animate-spin" />
                        Sending...
                      </>
                    ) : (
                      <>
                        Send Message
                        <Send className="w-4 h-4" />
                      </>
                    )}
                  </button>

                  <div className="flex items-center gap-2 text-sm text-gray-500">
                    <Lock className="w-4 h-4 text-green-500" />
                    <span>Your data is encrypted and secure</span>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
