const helpers = {
    isHighScore: scores => {
        const type = Object.keys(scores).reduce((prev, cur) => {
            if (prev === '') {
                prev = cur;
            } else {
                if (scores[prev] < scores[cur]) {
                    prev = cur;
                }
            }

            return prev;
        }, '');
        return type;
    },
}

export default helpers;
