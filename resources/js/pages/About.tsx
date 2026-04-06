import About from '@/components/sections/About';
import Services from '@/components/sections/Services';
import Team from '@/components/sections/Team';
import Contact from '@/components/sections/Contact';

export default function AboutPage() {
  return (
    <>
      <section className="py-20 bg-gradient-to-r from-slate-800 to-slate-900">
        <div className="container text-center">
          <h1 className="text-4xl md:text-5xl font-bold text-white mb-4">About Us</h1>
          <p className="text-slate-300 text-lg">Learn more about who we are and what we do</p>
        </div>
      </section>
      <About />
      <Services />
      <Team />
      <Contact />
    </>
  );
}
