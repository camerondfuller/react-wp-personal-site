var React = require('react');
var PropTypes = React.PropTypes;
import {browserHistory} from 'react-router';
import BlogLoop from './blog.jsx';
import Page from './page.jsx'

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
                     <span><a href="#">Contact</a></span>
                  </nav>
               </div>
            </header>
            {/*end of header */}

            {/*Beginning of body*/}
            <div className="page-background">
               <section className="hero-banner">
                  <div className="banner-middle-text">
                     <span>Center-Text</span>
                  </div>
                  <div className="down-arrow">
                     <i className="fa fa-angle-down"></i>
                  </div>
               </section>
               <section className="About">

               </section>
               <section className="Portfolio">

               </section>
               <section className="Blog">

               </section>
               <section className="Contact">

               </section>
            </div>
            {/*End of content*/}

            {/*Beginning of footer*/}
            <footer>
               <div>
               </div>
            </footer>
            {/*End of Footer*/}
         </div>
      );
   }

});

module.exports = HomePage;
