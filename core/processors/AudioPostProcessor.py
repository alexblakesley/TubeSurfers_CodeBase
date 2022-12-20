import os
import pandas as pd

def PostprocessAudio():
    fileDirectory = "data/audio"
    for n, filename in enumerate(os.listdir(fileDirectory)):
        data = pd.read_csv(os.path.join(fileDirectory, filename))
        data["Timestamps"] = data["Timestamps"]+3600
        data["spl"] = data["spl"]+34
        # print(data)
        data.to_csv("data/audio/_" + filename, index=False, header=True, sep=',')
        print(n)
