import React from 'react';
import {Link} from 'react-router-dom';
import HomePage from './HomePage';

const About = () => {
  return ( 
    <div className="about">
      <div className="about--brand-logo">
        <Link to={HomePage} className="about--brand-logo_link"><h1>Veissey</h1></Link>
      </div>
      <div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti minus ex iste, cum voluptatem voluptatum sequi facilis fugiat aperiam obcaecati sapiente sint vitae quod ullam, commodi ducimus quibusdam modi? Id at incidunt nihil dolores eum nostrum vel maiores laborum accusamus. Ab quisquam doloribus nulla consequatur facilis iusto officia animi, hic sequi at accusamus, nisi quos laborum earum aspernatur sunt perspiciatis veritatis, aperiam quidem eaque soluta suscipit culpa? Nemo reprehenderit ea beatae minus blanditiis corporis quae eos adipisci nam? Tempora doloremque eligendi qui consequuntur sed illo labore dignissimos, aliquam similique voluptate praesentium? Quae atque, corrupti dignissimos voluptates nam iusto ipsa. Sed sunt delectus blanditiis quaerat alias amet. Soluta exercitationem aliquam officia quae repellat quo amet id tempora numquam voluptatem culpa beatae unde accusamus pariatur, consequatur iusto ullam facilis voluptatibus totam suscipit voluptatum sapiente.</p>
        <p>Quas voluptate neque cumque aliquid ducimus, libero possimus hic reprehenderit quisquam, mollitia illo vel dignissimos expedita soluta minima. Molestias neque exercitationem repudiandae, ullam praesentium animi laborum cumque earum officiis quasi quia, nulla odit deleniti nobis ratione. Suscipit iste voluptates natus labore dolorem architecto, similique, nobis rem autem velit provident recusandae culpa optio debitis odit qui molestias officiis asperiores dolore, omnis accusamus aperiam. Fuga cupiditate minima ipsa sed eveniet.</p>
      </div>
    </div>
  );
}
 
export default About;