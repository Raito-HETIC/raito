import React from 'react';
import PropTypes from "prop-types";

import TextStyle from './Text.style';

const Text = ({
    className,
    children,
    color,
    size,
}) => {
  return (
    <TextStyle
        // Component
        className={className}
        // Style
        $color={color}
        $size={size}
    >
        {children}
    </TextStyle>
  )
}

Text.propTypes = {
  children: PropTypes.string,
  className: PropTypes.string,
  size: PropTypes.oneOf([
    'small',
    'medium',
    'large',
    'xlarge',
  ]),
  color: PropTypes.oneOf([
    'primary',
    'secondary',
    'terra',
  ]),
}

Text.defaultProps = {
  children: null,
  className: null,
  size: 'medium',
  color: 'primary'
}

export default Text;