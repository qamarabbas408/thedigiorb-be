import { useActiveTeam, useStatsBySection } from '@/hooks';

export default function Team() {
  const { data: members, isLoading } = useActiveTeam();
  const { data: stats } = useStatsBySection('team');

  const getInitials = (name: string) => {
    return name
      .split(' ')
      .map(n => n[0])
      .join('')
      .toUpperCase()
      .slice(0, 2);
  };

  const hasSocialLinks = (member: any) => {
    return (
      (member.facebook_url && member.facebook_url !== '#') ||
      (member.twitter_url && member.twitter_url !== '#') ||
      (member.linkedin_url && member.linkedin_url !== '#') ||
      (member.instagram_url && member.instagram_url !== '#')
    );
  };

  return (
    <section id="team" className="section">
      <div className="container">
        <div className="text-center mb-12">
          <h2 className="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Our Team</h2>
          <p className="text-slate-500">Meet the talented individuals behind our success</p>
        </div>

        {isLoading ? (
          <div className="flex justify-center py-12">
            <div className="w-10 h-10 border-4 border-gray-200 border-t-blue-500 rounded-full animate-spin" />
          </div>
        ) : !members || members.length === 0 ? (
          <div className="text-center py-12">
            <i className="bi bi-people text-6xl text-gray-300 mb-4" />
            <p className="text-gray-500">Our team is growing. Check back soon!</p>
          </div>
        ) : (
          <>
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
              {members.map((member, index) => (
                <div 
                  key={member.id} 
                  data-aos="fade-up" 
                  data-aos-delay={(index + 1) * 100}
                >
                  <div className="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
                    <div className="relative overflow-hidden">
                      {member.image ? (
                        <div className="w-full aspect-[4/5] bg-slate-100">
                          <img 
                            src={member.image}
                            className="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-110" 
                            alt={member.name}
                            onError={(e) => {
                              const target = e.target as HTMLImageElement;
                              const parent = target.parentElement;
                              if (parent) {
                                parent.innerHTML = `
                                  <div class="w-full aspect-[4/5] bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center">
                                    <span class="text-5xl font-bold text-white">${getInitials(member.name)}</span>
                                  </div>
                                `;
                              }
                            }}
                          />
                        </div>
                      ) : (
                        <div className="w-full aspect-[4/5] bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center">
                          <span className="text-5xl font-bold text-white">
                            {getInitials(member.name)}
                          </span>
                        </div>
                      )}
                      
                      {hasSocialLinks(member) && (
                        <div className="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4">
                          <div className="flex gap-3">
                            {member.facebook_url && member.facebook_url !== '#' && (
                              <a 
                                href={member.facebook_url} 
                                target="_blank" 
                                rel="noopener noreferrer"
                                className="w-9 h-9 bg-white rounded-full flex items-center justify-center text-slate-700 hover:bg-blue-500 hover:text-white transition-colors"
                              >
                                <i className="bi bi-facebook" />
                              </a>
                            )}
                            {member.twitter_url && member.twitter_url !== '#' && (
                              <a 
                                href={member.twitter_url} 
                                target="_blank" 
                                rel="noopener noreferrer"
                                className="w-9 h-9 bg-white rounded-full flex items-center justify-center text-slate-700 hover:bg-slate-800 hover:text-white transition-colors"
                              >
                                <i className="bi bi-twitter-x" />
                              </a>
                            )}
                            {member.linkedin_url && member.linkedin_url !== '#' && (
                              <a 
                                href={member.linkedin_url} 
                                target="_blank" 
                                rel="noopener noreferrer"
                                className="w-9 h-9 bg-white rounded-full flex items-center justify-center text-slate-700 hover:bg-blue-600 hover:text-white transition-colors"
                              >
                                <i className="bi bi-linkedin" />
                              </a>
                            )}
                            {member.instagram_url && member.instagram_url !== '#' && (
                              <a 
                                href={member.instagram_url} 
                                target="_blank" 
                                rel="noopener noreferrer"
                                className="w-9 h-9 bg-white rounded-full flex items-center justify-center text-slate-700 hover:bg-gradient-to-br hover:from-yellow-400 hover:to-pink-500 hover:text-white transition-colors"
                              >
                                <i className="bi bi-instagram" />
                              </a>
                            )}
                          </div>
                        </div>
                      )}
                    </div>
                    
                    <div className="p-5 text-center">
                      <h4 className="text-lg font-bold text-slate-800">{member.name}</h4>
                      {member.role && (
                        <p className="text-sm text-blue-500 font-medium mt-1">{member.role}</p>
                      )}
                    </div>
                  </div>
                </div>
              ))}
            </div>

            {stats && stats.length > 0 && (
              <div className="mt-16" data-aos="fade-up" data-aos-delay="500">
                <div className="bg-gradient-to-r from-slate-800 to-slate-900 rounded-2xl p-8 md:p-12">
                  <div className={`grid gap-8 text-center ${stats.length === 3 ? 'grid-cols-1 md:grid-cols-3' : stats.length === 2 ? 'grid-cols-2' : 'grid-cols-2 md:grid-cols-4'}`}>
                    {stats.map((stat, index) => (
                      <div key={stat.id} className={index > 0 && stats.length !== 2 ? 'hidden md:block border-l border-slate-700' : ''}>
                        <span className="block text-4xl md:text-5xl font-bold text-white mb-2">{stat.value}</span>
                        <span className="text-slate-400 text-sm uppercase tracking-wide">{stat.label}</span>
                      </div>
                    ))}
                  </div>
                </div>
              </div>
            )}
          </>
        )}
      </div>
    </section>
  );
}
