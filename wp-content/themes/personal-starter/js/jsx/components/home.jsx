var React = require('react');
var PropTypes = React.PropTypes;
import {browserHistory} from 'react-router';
import BlogLoop from './blog.jsx';

var HomePage = React.createClass({
   getInitialState: function() {
      return {

      };
   },
   render: function() {
      return (
         <div>
            <BlogLoop />
         </div>
      );
   }

});

module.exports = HomePage;
