var React = require('react');
var PropTypes = React.PropTypes;
import {browserHistory} from 'react-router';
import BlogLoop from './blog.jsx';
import About from './about.jsx'

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
                     <span><a href="#">About</a></span>
                     <span><a href="#">Portfolio</a></span>
                     <span><a href="#">Blog</a></span>
                     <span><a href="#">Contact</a></span>
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
               <section className="About">
                  <About />
               </section>
               <section className="Portfolio">
                  {/*Load the Portfolio component here*/}
               </section>
               <section className="Blog">
                  <BlogLoop />
               </section>
               <section className="Contact">

               </section>
            </div>
            {/*End of content*/}

            {/*Beginning of footer*/}
            <footer>
               <div className="menu-cont container">
                  <div>
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
