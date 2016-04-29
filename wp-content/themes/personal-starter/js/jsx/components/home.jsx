var React = require('react');
var PropTypes = React.PropTypes;
import {browserHistory} from 'react-router';
import BlogLoop from './blog.jsx';
import Page from './page.jsx'

var HomePage = React.createClass({
   getInitialState: function() {
      return {

      };
   },
   render: function() {
      return (
         <div className="page-background">
            <BlogLoop />
            <Page />
         </div>
      );
   }

});

module.exports = HomePage;
