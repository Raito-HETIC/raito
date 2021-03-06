import Birds from "components/atoms/embedding/Birds/Birds";
import Fire from "components/atoms/embedding/Fire/Fire";
import Forest from "components/atoms/embedding/Forest/Forest";
import IconEmptyHeart from "components/atoms/embedding/IconEmptyHeart/IconEmptyHeart";
import Waves from "components/atoms/embedding/Waves/Waves";

export const ambiancesList = [
  {
    id: 1,
    title: "Birds",
    url: "https://raitohetic.s3.eu-west-3.amazonaws.com/Birds.wav",
    illustration: <Birds fill="#FAF5E2" width={170} height={170}></Birds>,
    icon: <IconEmptyHeart fill="#A44D4D" width={27} height={27} />,
    author: "Team Raito",
    description:
      "Détendez-vous au doux son des oiseaux de cette forêt verdoyante. Relaxant et rafraichissant, laissez-vous porter...",
  },
  {
    id: 2,
    title: "Fire",
    url: "https://raitohetic.s3.eu-west-3.amazonaws.com/FIREBurn.wav",
    illustration: <Fire fill="#FAF5E2" width={170} height={170}></Fire>,
    icon: <IconEmptyHeart fill="#A44D4D" width={27} height={27} />,
    author: "Team Raito",
    description:
      "Crépitez au son de la flamme. Apaisez vous avec ce doux son rappelant le chocolat chaud et l'hiver ...",
  },
  {
    id: 3,
    title: "Water",
    url: "https://raitohetic.s3.eu-west-3.amazonaws.com/WATERWave.wav",
    illustration: <Waves fill="#FAF5E2" width={170} height={170}></Waves>,
    icon: <IconEmptyHeart fill="#A44D4D" width={27} height={27} />,
    author: "Team Raito",
    description:
      "Besoin de vous reconnecter à la nature ? Plongez-vous dans une ambiance de calme et de sérénité ...",
  },
  {
    id: 4,
    title: "Forest",
    url: "https://raitohetic.s3.eu-west-3.amazonaws.com/Forest.wav",
    illustration: <Forest fill="#FAF5E2" width={170} height={170}></Forest>,
    icon: <IconEmptyHeart fill="#A44D4D" width={27} height={27} />,
    author: "Team Raito",
    description:
      "Que diriez vous d'une balade en forêt? Laissez vous emporter par le son des feuilles qui craquellent ...",
  },
];
