import Portfolio from '@/components/sections/Portfolio';
import Contact from '@/components/sections/Contact';

export default function PortfolioPage() {
  return (
    <>
      <section className="py-20 bg-gradient-to-r from-slate-800 to-slate-900">
        <div className="container text-center">
          <h1 className="text-4xl md:text-5xl font-bold text-white mb-4">Our Portfolio</h1>
          <p className="text-slate-300 text-lg">Explore our latest projects and work</p>
        </div>
      </section>
      <Portfolio />
      <Contact />
    </>
  );
}
