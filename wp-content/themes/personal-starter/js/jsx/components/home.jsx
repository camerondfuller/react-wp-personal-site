var React = require('react');
var PropTypes = React.PropTypes;
import {browserHistory} from 'react-router';
import BlogLoop from './blog.jsx';
import About from './about.jsx';
import Portfolio from './portfolio.jsx';
import Contact from './contact.jsx';

var HomePage = React.createClass({

   render: function() {
      return (
         <div className="home">
            {/*Beginning of header*/}
            <header className="header header-transition">
               <div className="menu-cont container">
                  <div className="name-branding">
                     <a href="#top"><span className="title">Cameron D. Fuller</span></a>
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
            <div className="page-background" id="top">

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
                  <div className="left-side-name about-border-name">
                     <span>about</span>
                  </div>
                  <div className="animate-box-1">
                     <About source='wp-json/wp/v2/pages?filter[orderby]=menu_order' order={6}/>
                  </div>
               </section>

               <section className="Portfolio animation-element" id="portfolio">
                  <div className="left-side-name">
                     <span>Portfolio</span>
                  </div>
                  <div className="animate-box-2">
                     <Portfolio source='wp-json/wp/v2/pages?filter[orderby]=menu_order' order={0} />
                  </div>
               </section>

               <section className="Blog" id="blog">
                  <div className="left-side-name film-border-name">
                     <span>Blog</span>
                  </div>
                  <div className="animate-box-3 container">
                     <BlogLoop source="/wp-json/wp/v2/posts"/>
                  </div>
               </section>

               <section className="Film" id="film">
                  <div className="left-side-name film-border-name">
                     <span>Film</span>
                  </div>
                  <div className="animate-box-4">
                     <div className="container">
                        <h2>Marco Solo</h2>
                        <iframe src="https://player.vimeo.com/video/145091486" width="640" height="360" frameBorder="0" allowFullScreen></iframe>
                        <p><a href="https://vimeo.com/145091486" target="_blank">Marco Solo - Episode 1 - Trish</a> from <a href="https://vimeo.com/marcosolo" target="_blank">Marco Solo: The Web Series</a> on <a href="https://vimeo.com" target="_blank">Vimeo</a>.</p>
                     </div>
                  </div>
               </section>

               <section className="Contact" id="contact">
                  <div className="left-side-name contact-side-name">
                     <span>Contact</span>
                  </div>
                  <div className="animate-box-5">
                     <Contact source='wp-json/wp/v2/pages'/>
                  </div>
               </section>
            </div>
            {/*End of content*/}

            {/*Beginning of footer*/}
            <footer>
               <div className="menu-cont container">
                  <div className="copyright">
                     <span>&copy;2016 Cameron D. Fuller</span>
                  </div>
                  <div className="social">
                     <a href="http://www.facebook.com/Franksjacket" target="_blank"><i className="fa fa-facebook"></i></a>
                     <a href="http://www.instagram.com/franksjacket/" target="_blank"><i className="fa fa-instagram"></i></a>
                     <a href="http://twitter.com/camerondfuller" target="_blank"><i className="fa fa-twitter"></i></a>
                  </div>
               </div>
            </footer>
            {/*End of Footer*/}
         </div>
      );
   }

});

module.exports = HomePage;
