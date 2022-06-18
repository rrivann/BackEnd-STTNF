// const formatName = (name) => {
//   const result = name.toUpperCase();
//   return result;
// };

// const getName = (name, callFormatName) => {
//   console.log(callFormatName(name));
// };

// getName('rivan', formatName);

// promise
const download = () => {
  return new Promise((succ, err) => {
    const status = true;
    if (status) {
      console.log('success');
    } else {
      console.log('failed');
    }
  });
};

const main = async () => {
  await download();
};

main();
