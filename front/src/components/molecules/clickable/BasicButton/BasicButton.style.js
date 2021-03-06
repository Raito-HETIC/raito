import styled from "styled-components";

const BasicButtonStyle = styled.button`
  color: ${(props) => (props.primary ? "#F3EDD7" : "#a44d4d")};
  background-color: ${(props) => (props.primary ? "#a44d4d" : "transparent")};
  font-size: 1em;
  font-weight: 600;
  margin: 5px;
  padding: 0.35em 1em;
  border: none;
  border-radius: 14px;
  &:hover {
    background-color: ${(props) => (props.primary ? "#ce6060" : "none")};
    color: ${(props) => (props.primary ? "#F3EDD7" : "#ce6060")};
  }
`;

export default BasicButtonStyle;
