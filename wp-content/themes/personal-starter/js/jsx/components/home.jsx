var React = require('react');
var PropTypes = React.PropTypes;
import {browserHistory} from 'react-router';
import BlogLoop from './blog.jsx';
import About from './about.jsx';
import Portfolio from './portfolio.jsx';

var HomePage = React.createClass({

   render: function() {
      return (
         <div>
            {/*Beginning of header*/}
            <header className="header">
               <div className="menu-cont container">
                  <div className="name-branding">
                     <span>Cameron D. Fuller</span>
                  </div>
                  <nav className="main-nav">
                     <span><a href="#about">About</a></span>
                     <span><a href="#portfolio">Portfolio</a></span>
                     <span><a href="#blog">Blog</a></span>
                     <span><a href="#film">Film</a></span>
                     <span><a href="#contact">Contact</a></span>
                  </nav>
               </div>
            </header>
            {/*end of header */}

            {/*Beginning of body*/}
            <div className="page-background">

               <section className="hero-banner">
                  <div className="down-arrow">
                     <i className="fa fa-angle-down"></i>
                  </div>
                  <div className="banner-middle-text">
                     <span>Creating Possibilities</span>
                     <p>Writer | Developer | Film Maker</p>
                  </div>
               </section>

               <section className="About" id="about">
                  <About source='wp-json/wp/v2/pages?filter[orderby]=menu_order' order={6}/>
               </section>

               <section className="Portfolio" id="portfolio">
                  <Portfolio source='wp-json/wp/v2/pages?filter[orderby]=menu_order' order={0} />
               </section>

               <section className="Blog" id="blog">
                  <BlogLoop source="/wp-json/wp/v2/posts"/>
               </section>

               <section className="Film" id="film">
                  <div className="left-side-name film-border-name">
                     <span>Film</span>
                  </div>
                  <div className="container">
                     <h2>Marco Solo</h2>
                     <iframe src="https://player.vimeo.com/video/145091486" width="640" height="360" frameBorder="0" allowFullScreen></iframe>
                     <p><a href="https://vimeo.com/145091486">Marco Solo - Episode 1 - Trish</a> from <a href="https://vimeo.com/marcosolo">Marco Solo: The Web Series</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
                  </div>
               </section>

               <section className="Contact" id="contact">

               </section>
            </div>
            {/*End of content*/}

            {/*Beginning of footer*/}
            <footer>
               <div className="menu-cont container">
                  <div className="copyright">
                     <span>&copy;2016 Cameron Fuller</span>
                  </div>
                  <div className="social">
                     <a href="#"><i className="fa fa-facebook"></i></a>
                     <a href="#"><i className="fa fa-instagram"></i></a>
                     <a href="#"><i className="fa fa-twitter"></i></a>
                  </div>
               </div>
            </footer>
            {/*End of Footer*/}
         </div>
      );
   }

});

module.exports = HomePage;
